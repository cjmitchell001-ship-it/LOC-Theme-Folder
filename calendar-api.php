<?php
/**
 * Leicester Oven Cleaning — Google Calendar API
 *
 * Provides calendar availability lookup and provisional booking creation.
 * Requires vendor/autoload.php (google/apiclient installed via Composer).
 */

require_once __DIR__ . '/vendor/autoload.php';

$_LOC_CREDENTIALS_FILE = __DIR__ . '/client_secret_212238838163-k4gs5q3ulqgp15tnamdq53dv3l7k92i6.apps.googleusercontent.com.json';
$_LOC_TOKEN_FILE       = __DIR__ . '/token.json';
$_LOC_CALENDAR_ID      = '514d8e2bd29573d1582ae633e39ee999679bc205ee207a15c019b1aed196f67d@group.calendar.google.com';

// Day-level job caps. Weekdays: Chris only wants one evening job on a work
// night. Weekends: three average jobs fit back-to-back in the six-hour
// Morning window. Adjust here if capacity changes later.
define( 'LOC_WEEKDAY_JOB_CAP', 1 );
define( 'LOC_WEEKEND_JOB_CAP', 3 );


// ============================================================
// loc_get_google_client()
// Returns a configured Google_Client, with token loaded if valid.
// ============================================================

function loc_get_google_client() {
    global $_LOC_CREDENTIALS_FILE, $_LOC_TOKEN_FILE;

    $client = new Google\Client();
    $client->setApplicationName( 'Leicester Oven Cleaning' );
    $client->setScopes( Google\Service\Calendar::CALENDAR );
    $client->setAuthConfig( $_LOC_CREDENTIALS_FILE );
    $client->setAccessType( 'offline' );
    $client->setPrompt( 'consent' );

    if ( file_exists( $_LOC_TOKEN_FILE ) ) {
        $token = json_decode( file_get_contents( $_LOC_TOKEN_FILE ), true );
        $client->setAccessToken( $token );

        if ( $client->isAccessTokenExpired() ) {
            $refreshToken = $client->getRefreshToken();
            if ( $refreshToken ) {
                $client->fetchAccessTokenWithRefreshToken( $refreshToken );
                file_put_contents( $_LOC_TOKEN_FILE, json_encode( $client->getAccessToken() ) );
            }
        }
    }

    return $client;
}


// ============================================================
// loc_get_calendar_service()
// Returns a Google_Service_Calendar, or 'AUTH_REQUIRED:<url>' string.
// ============================================================

function loc_get_calendar_service() {
    $client = loc_get_google_client();

    if ( ! $client->getAccessToken() || $client->isAccessTokenExpired() ) {
        $authUrl = $client->createAuthUrl();
        return 'AUTH_REQUIRED:' . $authUrl;
    }

    return new Google\Service\Calendar( $client );
}


// ============================================================
// loc_get_available_slots( $zone, $duration_minutes, $days_ahead )
//
// Availability rules:
//   - No-zone date (no all-day zone event): shown to ALL customers.
//   - Zone-labelled date (all-day event titled North/South/East/West/Central):
//     shown only to customers whose $zone matches that label.
//   - Fully booked date (both morning and afternoon taken): hidden for everyone.
//   - Past dates: always hidden.
//
// Returns array of [ 'date' => 'YYYY-MM-DD', 'morning' => bool, 'afternoon' => bool ]
// ============================================================

function loc_get_available_slots( $zone, $duration_minutes, $days_ahead ) {
    global $_LOC_CALENDAR_ID;

    $service = loc_get_calendar_service();
    if ( is_string( $service ) ) {
        return $service; // AUTH_REQUIRED:...
    }

    $tz  = new DateTimeZone( 'Europe/London' );
    $now = new DateTime( 'today', $tz );
    $end = clone $now;
    $end->modify( '+' . intval( $days_ahead ) . ' days' );

    $timeMin = $now->format( DateTime::RFC3339 );
    $timeMax = $end->format( DateTime::RFC3339 );

    // Fetch all events in window
    try {
        $events = $service->events->listEvents( $_LOC_CALENDAR_ID, [
            'timeMin'      => $timeMin,
            'timeMax'      => $timeMax,
            'singleEvents' => true,
            'orderBy'      => 'startTime',
        ] );
    } catch ( Exception $e ) {
        return [];
    }

    $knownZones = [ 'north', 'south', 'east', 'west', 'central' ];

    // Index zone all-day events and timed events by date
    $zonedDates   = []; // date => zone label (lowercase) — only dates with a zone all-day event
    $timedByDay   = []; // date => array of [start_ts, end_ts]
    $jobCountByDay = []; // date => number of genuine job bookings (provisional or confirmed)

    foreach ( $events->getItems() as $event ) {
        $start = $event->getStart();
        $end_e = $event->getEnd();

        if ( $start->getDate() ) {
            // All-day event — record if it carries a known zone label
            $title = strtolower( trim( $event->getSummary() ) );
            if ( in_array( $title, $knownZones ) ) {
                $zonedDates[ $start->getDate() ] = $title;
            }
        } else {
            // Timed event — record as an occupied block
            $date = ( new DateTime( $start->getDateTime() ) )->format( 'Y-m-d' );
            $timedByDay[ $date ][] = [
                strtotime( $start->getDateTime() ),
                strtotime( $end_e->getDateTime() ),
            ];

            // Count genuine job bookings only — excludes the recurring
            // "Unavailable" day-blocking events, which are not jobs.
            $title = strtolower( trim( $event->getSummary() ) );
            if ( strpos( $title, 'provisional:' ) === 0 || strpos( $title, 'confirmed:' ) === 0 ) {
                $jobCountByDay[ $date ] = ( $jobCountByDay[ $date ] ?? 0 ) + 1;
            }
        }
    }

    $slots     = [];
    $zoneLower = strtolower( $zone );
    $cursor    = clone $now;

    while ( $cursor < $end ) {
        $dateStr = $cursor->format( 'Y-m-d' );

        // Zone-labelled date that doesn't match this customer's zone — skip
        if ( isset( $zonedDates[ $dateStr ] ) && $zonedDates[ $dateStr ] !== $zoneLower ) {
            $cursor->modify( '+1 day' );
            continue;
        }

        // Check morning (07:00–13:00) and afternoon (13:00–18:00) slots
        $morning   = loc_slot_is_free( $dateStr, '07:00', '13:00', $duration_minutes, $timedByDay );
        $afternoon = loc_slot_is_free( $dateStr, '13:00', '18:00', $duration_minutes, $timedByDay );

        // Day-level job cap — sits alongside the time-window check above.
        // Once a day hits its cap, it's fully unavailable regardless of
        // remaining unused hours in the window.
        $isWeekend = in_array( $cursor->format( 'N' ), [ 6, 7 ], true );
        $jobCap    = $isWeekend ? LOC_WEEKEND_JOB_CAP : LOC_WEEKDAY_JOB_CAP;
        $jobCount  = $jobCountByDay[ $dateStr ] ?? 0;

        if ( $jobCount >= $jobCap ) {
            $morning   = false;
            $afternoon = false;
        }

        // Only include if at least one slot is free
        if ( $morning || $afternoon ) {
            $slots[] = [
                'date'      => $dateStr,
                'morning'   => $morning,
                'afternoon' => $afternoon,
            ];
        }

        $cursor->modify( '+1 day' );
    }

    return $slots;
}


// Helper: checks whether a contiguous block of $duration_minutes fits within
// a slot window (e.g. 07:00-13:00) given existing timed events on that date.
function loc_slot_is_free( $date, $slot_start, $slot_end, $duration_minutes, $timedByDay ) {
    $tz        = new DateTimeZone( 'Europe/London' );
    $windowStart = strtotime( ( new DateTime( $date . ' ' . $slot_start, $tz ) )->format( DateTime::RFC3339 ) );
    $windowEnd   = strtotime( ( new DateTime( $date . ' ' . $slot_end,   $tz ) )->format( DateTime::RFC3339 ) );
    $required    = $duration_minutes * 60;

    // Build sorted list of busy periods within this window
    $busy = [];
    if ( isset( $timedByDay[ $date ] ) ) {
        foreach ( $timedByDay[ $date ] as $block ) {
            $bs = max( $block[0], $windowStart );
            $be = min( $block[1], $windowEnd );
            if ( $bs < $be ) {
                $busy[] = [ $bs, $be ];
            }
        }
    }
    usort( $busy, function( $a, $b ) { return $a[0] - $b[0]; } );

    // Walk free gaps and check if any fits the required duration
    $cursor = $windowStart;
    foreach ( $busy as $block ) {
        if ( $block[0] - $cursor >= $required ) {
            return true;
        }
        $cursor = max( $cursor, $block[1] );
    }

    return ( $windowEnd - $cursor >= $required );
}


// ============================================================
// loc_create_provisional_booking(
//     $date, $slot, $customer_name, $phone, $email,
//     $appliances, $duration_minutes, $zone )
// Creates a PROVISIONAL timed event on the Jobs calendar.
// $slot: 'morning' (07:00) or 'afternoon' (13:00).
// Returns true on success, false on failure.
// ============================================================

function loc_create_provisional_booking( $date, $slot, $customer_name, $phone, $email, $appliances, $duration_minutes, $zone, $callback_time = '' ) {
    global $_LOC_CALENDAR_ID;

    $service = loc_get_calendar_service();
    if ( is_string( $service ) ) {
        return false; // not authorised
    }

    $tz         = 'Europe/London';
    $startHour  = ( $slot === 'afternoon' ) ? '13:00' : '07:00';
    $startDt    = new DateTime( $date . ' ' . $startHour, new DateTimeZone( $tz ) );
    $endDt      = clone $startDt;
    $endDt->modify( '+' . intval( $duration_minutes ) . ' minutes' );

    if ( is_array( $appliances ) && ! empty( $appliances ) ) {
        $applianceLines = [];
        foreach ( $appliances as $name => $price ) {
            $applianceLines[] = '  ' . $name . ' — £' . $price;
        }
        $applianceBlock = implode( "\n", $applianceLines );
    } else {
        $applianceBlock = '  To be discussed on the call';
    }

    $description = implode( "\n", [
        'Name:       ' . $customer_name,
        'Phone:      ' . $phone,
        'Email:      ' . $email,
        'Zone:       ' . $zone,
        'Callback:   ' . ( $callback_time ?: 'Not specified' ),
        'Duration:   ' . $duration_minutes . ' min',
        'Status:     PROVISIONAL — awaiting confirmation call',
        '',
        'Appliances:',
        $applianceBlock,
    ] );

    $event = new Google\Service\Calendar\Event( [
        'summary'     => 'PROVISIONAL: ' . $customer_name,
        'description' => $description,
        'start'       => [
            'dateTime' => $startDt->format( DateTime::RFC3339 ),
            'timeZone' => $tz,
        ],
        'end'         => [
            'dateTime' => $endDt->format( DateTime::RFC3339 ),
            'timeZone' => $tz,
        ],
    ] );

    try {
        $service->events->insert( $_LOC_CALENDAR_ID, $event );
        return true;
    } catch ( Exception $e ) {
        return false;
    }
}

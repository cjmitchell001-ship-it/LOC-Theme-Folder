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
$_LOC_CALENDAR_ID      = 'primary'; // replace with real calendar ID once confirmed


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
// Queries the Jobs calendar for zone-labelled all-day events,
// then checks morning (07:00-13:00) and afternoon (13:00-18:00)
// for free blocks of at least $duration_minutes.
// Returns array of [ 'date' => 'YYYY-MM-DD', 'morning' => bool, 'afternoon' => bool ]
// ============================================================

function loc_get_available_slots( $zone, $duration_minutes, $days_ahead ) {
    global $_LOC_CALENDAR_ID;

    $service = loc_get_calendar_service();
    if ( is_string( $service ) ) {
        return $service; // AUTH_REQUIRED:...
    }

    $now       = new DateTime( 'today', new DateTimeZone( 'Europe/London' ) );
    $end       = clone $now;
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

    // Index all-day zone markers and timed events by date
    $zoneDays   = []; // dates that have a matching zone all-day event
    $timedByDay = []; // date => array of [start_ts, end_ts]

    foreach ( $events->getItems() as $event ) {
        $start = $event->getStart();
        $end_e = $event->getEnd();

        if ( $start->getDate() ) {
            // All-day event — check if title matches zone
            $title = trim( $event->getSummary() );
            if ( strcasecmp( $title, $zone ) === 0 ) {
                $zoneDays[ $start->getDate() ] = true;
            }
        } else {
            // Timed event — record as occupied block
            $date = ( new DateTime( $start->getDateTime() ) )->format( 'Y-m-d' );
            $timedByDay[ $date ][] = [
                strtotime( $start->getDateTime() ),
                strtotime( $end_e->getDateTime() ),
            ];
        }
    }

    $slots = [];

    foreach ( $zoneDays as $date => $_ ) {
        $morning   = loc_slot_is_free( $date, '07:00', '13:00', $duration_minutes, $timedByDay );
        $afternoon = loc_slot_is_free( $date, '13:00', '18:00', $duration_minutes, $timedByDay );

        if ( $morning || $afternoon ) {
            $slots[] = [
                'date'      => $date,
                'morning'   => $morning,
                'afternoon' => $afternoon,
            ];
        }
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

function loc_create_provisional_booking( $date, $slot, $customer_name, $phone, $email, $appliances, $duration_minutes, $zone ) {
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

    $applianceText = is_array( $appliances )
        ? implode( ', ', array_map( function( $name, $price ) {
            return $name . ' (£' . $price . ')';
          }, array_keys( $appliances ), $appliances ) )
        : (string) $appliances;

    $description = implode( "\n", [
        'Name:       ' . $customer_name,
        'Phone:      ' . $phone,
        'Email:      ' . $email,
        'Zone:       ' . $zone,
        'Appliances: ' . $applianceText,
        'Duration:   ' . $duration_minutes . ' min',
        'Status:     PROVISIONAL — awaiting confirmation call',
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

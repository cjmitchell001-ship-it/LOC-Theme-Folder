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
                $newToken = $client->fetchAccessTokenWithRefreshToken( $refreshToken );
                // Only persist a successful refresh — a failed refresh returns
                // an error array, and writing that to token.json destroys the
                // stored refresh token.
                if ( empty( $newToken['error'] ) ) {
                    file_put_contents( $_LOC_TOKEN_FILE, json_encode( $client->getAccessToken() ) );
                } else {
                    error_log( 'LOC calendar: token refresh failed — ' . $newToken['error'] . '. Re-auth needed at /?loc_calendar_auth=1' );
                }
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
        // createAuthUrl() throws if no redirect URI is configured (it only is
        // during the interactive OAuth flow) — never let that fatal a
        // customer-facing request.
        try {
            $authUrl = $client->createAuthUrl();
        } catch ( \Exception $e ) {
            $authUrl = '';
        }
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
//   - "Open: N" / "Open: N AM" / "Open: N PM" override date (all-day event,
//     can span multiple days e.g. a holiday): replaces the normal weekday/
//     weekend job cap with N for that date, and ignores that date's
//     recurring "Unavailable" block entirely — the override is treated as
//     the whole truth for that date, not layered on top of normal rules.
//     AM/PM restricts which single window is open; omitting it opens both.
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
    $zonedDates    = []; // date => zone label (lowercase) — only dates with a zone all-day event
    $timedByDay    = []; // date => array of [start_ts, end_ts, title]
    $jobCountByDay = []; // date => number of genuine job bookings (provisional or confirmed)
    $jobZonesByDay = []; // date => array of booking zones (lowercase), parsed from event descriptions
    $openOverride  = []; // date => [ 'cap' => int, 'window' => 'both'|'am'|'pm' ]

    foreach ( $events->getItems() as $event ) {
        $start = $event->getStart();
        $end_e = $event->getEnd();

        if ( $start->getDate() ) {
            // All-day event — record if it carries a known zone label or an
            // "Open: N [AM|PM]" capacity override. Can span multiple days
            // (e.g. a holiday block), so expand across the full date range —
            // Google returns multi-day all-day events as one item with a
            // start/end pair, not one item per day.
            $title = strtolower( trim( $event->getSummary() ) );

            if ( in_array( $title, $knownZones, true ) ) {
                $zonedDates[ $start->getDate() ] = $title;
            } elseif ( preg_match( '/^open\s*:\s*(\d+)\s*(am|pm)?$/', $title, $om ) ) {
                $tzL      = new DateTimeZone( 'Europe/London' );
                $dCursor  = new DateTime( $start->getDate(), $tzL );
                $dEnd     = new DateTime( $end_e->getDate(), $tzL ); // exclusive
                $window   = isset( $om[2] ) ? $om[2] : 'both';
                while ( $dCursor < $dEnd ) {
                    $openOverride[ $dCursor->format( 'Y-m-d' ) ] = [
                        'cap'    => (int) $om[1],
                        'window' => $window,
                    ];
                    $dCursor->modify( '+1 day' );
                }
            }
        } else {
            // Timed event — record as an occupied block
            $date  = ( new DateTime( $start->getDateTime() ) )->format( 'Y-m-d' );
            $title = strtolower( trim( $event->getSummary() ) );
            $timedByDay[ $date ][] = [
                strtotime( $start->getDateTime() ),
                strtotime( $end_e->getDateTime() ),
                $title,
            ];

            // Count genuine job bookings only — excludes the recurring
            // "Unavailable" day-blocking events, which are not jobs.
            if ( strpos( $title, 'provisional:' ) === 0 || strpos( $title, 'confirmed:' ) === 0 ) {
                $jobCountByDay[ $date ] = ( $jobCountByDay[ $date ] ?? 0 ) + 1;

                // Record the booking's zone (from the "Zone:" line written
                // into the description at booking time) so stale zone labels
                // can be detected below.
                if ( preg_match( '/^Zone:\s*(\S+)/mi', (string) $event->getDescription(), $m ) ) {
                    $jobZonesByDay[ $date ][] = strtolower( $m[1] );
                }
            }
        }
    }

    // Ignore stale zone labels: a label only holds if at least one surviving
    // job booking on that date belongs to the labelled zone. This makes
    // manual label cleanup after a cancellation optional — a label whose
    // last matching booking was deleted is treated as if it weren't there.
    foreach ( $zonedDates as $labelDate => $label ) {
        if ( ! in_array( $label, $jobZonesByDay[ $labelDate ] ?? [], true ) ) {
            unset( $zonedDates[ $labelDate ] );
        }
    }

    $slots     = [];
    $zoneLower = strtolower( $zone );
    $cursor    = clone $now;

    while ( $cursor < $end ) {
        $dateStr = $cursor->format( 'Y-m-d' );

        // Zone-labelled date: visible to that zone's customers AND Central
        // customers (Central is zone-neutral). Everyone else skips the day.
        if ( isset( $zonedDates[ $dateStr ] ) && $zonedDates[ $dateStr ] !== $zoneLower && $zoneLower !== 'central' ) {
            $cursor->modify( '+1 day' );
            continue;
        }

        $override = $openOverride[ $dateStr ] ?? null;

        // On an override date, the recurring "Unavailable" block is ignored
        // entirely — the override is the whole truth for that date, not
        // layered on top of the normal weekday/weekend window rules.
        $excludeTitles = $override ? [ 'unavailable' ] : [];

        // Check morning (07:00–13:00) and afternoon (13:00–18:00) slots
        $morning   = loc_slot_is_free( $dateStr, '07:00', '13:00', $duration_minutes, $timedByDay, $excludeTitles );
        $afternoon = loc_slot_is_free( $dateStr, '13:00', '18:00', $duration_minutes, $timedByDay, $excludeTitles );

        if ( $override ) {
            // AM/PM restricts to a single window; omitting it opens both.
            if ( $override['window'] === 'am' ) {
                $afternoon = false;
            } elseif ( $override['window'] === 'pm' ) {
                $morning = false;
            }
        }

        // Day-level job cap — sits alongside the time-window check above.
        // Once a day hits its cap, it's fully unavailable regardless of
        // remaining unused hours in the window. An override date uses its
        // own cap instead of the normal weekday/weekend cap.
        $isWeekend = in_array( (int) $cursor->format( 'N' ), [ 6, 7 ], true );
        $jobCap    = $override ? $override['cap'] : ( $isWeekend ? LOC_WEEKEND_JOB_CAP : LOC_WEEKDAY_JOB_CAP );
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
// $excludeTitles: lowercase event titles to ignore entirely (e.g. the
// recurring "Unavailable" block, on a date with an "Open: N" override).
function loc_slot_is_free( $date, $slot_start, $slot_end, $duration_minutes, $timedByDay, $excludeTitles = [] ) {
    $tz        = new DateTimeZone( 'Europe/London' );
    $windowStart = strtotime( ( new DateTime( $date . ' ' . $slot_start, $tz ) )->format( DateTime::RFC3339 ) );
    $windowEnd   = strtotime( ( new DateTime( $date . ' ' . $slot_end,   $tz ) )->format( DateTime::RFC3339 ) );
    $required    = $duration_minutes * 60;

    // Build sorted list of busy periods within this window
    $busy = [];
    if ( isset( $timedByDay[ $date ] ) ) {
        foreach ( $timedByDay[ $date ] as $block ) {
            if ( $excludeTitles && in_array( $block[2] ?? '', $excludeTitles, true ) ) {
                continue;
            }
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
    } catch ( Exception $e ) {
        return false;
    }

    // Auto-create the day's zone label on the first North/South/East/West
    // booking. Central is zone-neutral and never sets a label. A label
    // failure must not fail the booking — the availability logic derives
    // the effective zone from the bookings themselves, so the label is a
    // visual aid on the calendar, not the source of truth.
    try {
        loc_ensure_zone_label( $service, $date, $zone );
    } catch ( Exception $e ) {
        // non-fatal
    }

    return true;
}


// Helper: keeps $date's zone-label events in step with its surviving bookings.
// Deletes stale labels (no remaining PROVISIONAL:/Confirmed: booking of that
// zone on the date — e.g. an East label left behind after the East customer
// cancelled), then adds the new booking's label if the zone is
// non-Central and its label isn't already present.
function loc_ensure_zone_label( $service, $date, $zone ) {
    global $_LOC_CALENDAR_ID;

    $zoneLower = strtolower( trim( $zone ) );
    if ( ! in_array( $zoneLower, [ 'north', 'south', 'east', 'west' ], true ) ) {
        return; // Central, empty, or unrecognised — never sets a label
    }

    $tz       = new DateTimeZone( 'Europe/London' );
    $dayStart = new DateTime( $date . ' 00:00', $tz );
    $dayEnd   = clone $dayStart;
    $dayEnd->modify( '+1 day' );

    $events = $service->events->listEvents( $_LOC_CALENDAR_ID, [
        'timeMin'      => $dayStart->format( DateTime::RFC3339 ),
        'timeMax'      => $dayEnd->format( DateTime::RFC3339 ),
        'singleEvents' => true,
    ] );

    $knownZones  = [ 'north', 'south', 'east', 'west', 'central' ];
    $labelEvents = []; // zone => event, existing label events on this date
    $activeZones = []; // zones of surviving job bookings (includes the one just created)

    foreach ( $events->getItems() as $event ) {
        $title = strtolower( trim( $event->getSummary() ) );

        if ( $event->getStart()->getDate() ) {
            if ( in_array( $title, $knownZones, true ) ) {
                $labelEvents[ $title ] = $event;
            }
        } elseif ( strpos( $title, 'provisional:' ) === 0 || strpos( $title, 'confirmed:' ) === 0 ) {
            if ( preg_match( '/^Zone:\s*(\S+)/mi', (string) $event->getDescription(), $m ) ) {
                $activeZones[] = strtolower( $m[1] );
            }
        }
    }

    // Delete stale labels so the calendar shows the day's true zone
    foreach ( $labelEvents as $labelZone => $labelEvent ) {
        if ( ! in_array( $labelZone, $activeZones, true ) ) {
            $service->events->delete( $_LOC_CALENDAR_ID, $labelEvent->getId() );
            unset( $labelEvents[ $labelZone ] );
        }
    }

    if ( isset( $labelEvents[ $zoneLower ] ) ) {
        return; // this zone's label already exists
    }

    $label = new Google\Service\Calendar\Event( [
        'summary' => ucfirst( $zoneLower ),
        'start'   => [ 'date' => $date ],
        'end'     => [ 'date' => $dayEnd->format( 'Y-m-d' ) ],
    ] );
    $service->events->insert( $_LOC_CALENDAR_ID, $label );
}


// ============================================================
// loc_send_upcoming_reminders()
//
// Finds CONFIRMED jobs (Chris has manually renamed the event
// "Confirmed: Name" after the confirmation call) starting exactly
// LOC_REMINDER_DAYS_BEFORE days from today, and emails the customer
// a reminder. Provisional (unconfirmed) bookings are skipped — they
// haven't had the confirmation call yet, so a reminder would be
// premature.
//
// Idempotent: once a reminder is sent, the event description is
// patched with a "Reminder: sent" marker so a duplicate run (cron
// misfire, manual re-trigger) never emails the customer twice.
//
// Called by a WP-Cron daily event and by an external cron ping
// (see loc_handle_send_reminders() in functions.php) — the latter
// is the reliable trigger pre-launch, since WP-Cron only fires on
// site traffic.
// ============================================================

define( 'LOC_REMINDER_DAYS_BEFORE', 3 );

function loc_send_upcoming_reminders() {
    global $_LOC_CALENDAR_ID;

    $service = loc_get_calendar_service();
    if ( is_string( $service ) ) {
        return; // not authorised — nothing to do
    }

    $tz     = new DateTimeZone( 'Europe/London' );
    $target = new DateTime( 'today', $tz );
    $target->modify( '+' . LOC_REMINDER_DAYS_BEFORE . ' days' );
    $dayStart = clone $target;
    $dayEnd   = clone $target;
    $dayEnd->modify( '+1 day' );

    try {
        $events = $service->events->listEvents( $_LOC_CALENDAR_ID, [
            'timeMin'      => $dayStart->format( DateTime::RFC3339 ),
            'timeMax'      => $dayEnd->format( DateTime::RFC3339 ),
            'singleEvents' => true,
            'orderBy'      => 'startTime',
        ] );
    } catch ( Exception $e ) {
        return;
    }

    foreach ( $events->getItems() as $event ) {
        $start = $event->getStart();
        if ( ! $start->getDateTime() ) {
            continue; // all-day zone label, not a job
        }

        $title = trim( (string) $event->getSummary() );
        if ( stripos( $title, 'confirmed:' ) !== 0 ) {
            continue; // only remind confirmed jobs
        }

        $description = (string) $event->getDescription();

        if ( stripos( $description, 'Reminder: sent' ) !== false ) {
            continue; // already reminded
        }

        if ( ! preg_match( '/^Name:\s*(.+)$/mi', $description, $mName ) ) {
            continue;
        }
        if ( ! preg_match( '/^Email:\s*(.+)$/mi', $description, $mEmail ) ) {
            continue;
        }

        $customerName = trim( $mName[1] );
        $email        = trim( $mEmail[1] );
        $firstName    = trim( explode( ' ', $customerName )[0] );

        if ( ! is_email( $email ) ) {
            continue;
        }

        $startDt = new DateTime( $start->getDateTime() );
        $startDt->setTimezone( $tz );
        $dateFormatted = $startDt->format( 'l j F Y' );
        $slotDisplay   = ( (int) $startDt->format( 'H' ) < 13 ) ? 'Morning (7am – 1pm)' : 'Afternoon (1pm – 6pm)';

        $subject = 'Reminder — your oven clean is on ' . $startDt->format( 'l j F' );
        $body    = <<<EOT
Hi {$firstName},

Just a reminder — we're booked in to clean your oven on {$dateFormatted} ({$slotDisplay}).

WHAT TO HAVE READY ON THE DAY
- Clear access to the oven(s) — please remove any trays, shelves, or items stored inside before we arrive
- Access to a cold water tap — and hot water where available
- Remaining balance ready to pay on the day — cash or bank transfer

If anything's changed or you need to reschedule, just get in touch on 07710 649 360 or hello@leicesterovencleaning.co.uk.

See you soon,
Leicester Oven Cleaning
EOT;

        $sent = wp_mail( $email, $subject, $body, [ 'Content-Type: text/plain; charset=UTF-8' ] );

        if ( $sent ) {
            try {
                $event->setDescription( $description . "\nReminder: sent " . ( new DateTime( 'now', $tz ) )->format( 'Y-m-d H:i' ) );
                $service->events->patch( $_LOC_CALENDAR_ID, $event->getId(), $event );
            } catch ( Exception $e ) {
                // Non-fatal — worst case a duplicate trigger re-sends once more.
            }
        }
    }
}

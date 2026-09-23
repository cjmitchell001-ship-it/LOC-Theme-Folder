<?php
/**
 * Leicester Oven Cleaning — Reservation handler
 *
 * Defines loc_handle_reservation(), registered as a WordPress AJAX action
 * in functions.php. WordPress is already loaded when this function runs,
 * so wp_mail(), sanitisation functions, and calendar-api.php are all available.
 *
 * Called via POST to /wp-admin/admin-ajax.php?action=loc_reservation.
 * No wp-load.php bootstrap needed here.
 */

// ── CALL TIMING ───────────────────────────────────────────────────────────
//
// The hour I stop making confirmation calls (24h clock). Agreed 23 Sep 2026.
// This is ALSO the end of the Evening callback window, so the site never
// offers a slot I will not ring in — if you move this, move the Evening
// window shown on Step 3 with it.
if ( ! defined( 'LOC_CALL_CUTOFF_HOUR' ) ) {
    define( 'LOC_CALL_CUTOFF_HOUR', 19 ); // 7pm
}

// The "first thing" call, used when a booking rolls onto the day of the job
// itself. Deliberately before the 8am start of the Morning window: a morning
// job can begin at 7am, so this needs to beat the van.
if ( ! defined( 'LOC_CALL_FIRST_THING' ) ) {
    define( 'LOC_CALL_FIRST_THING', '7:30am' );
}

function loc_handle_reservation() {

    header( 'Content-Type: application/json' );

    // ── SANITISE POST FIELDS ──────────────────────────────────────────────

    $first_name       = sanitize_text_field( wp_unslash( $_POST['first_name']       ?? '' ) );
    $last_name        = sanitize_text_field( wp_unslash( $_POST['last_name']        ?? '' ) );
    $phone            = sanitize_text_field( wp_unslash( $_POST['phone']            ?? '' ) );
    $email            = sanitize_email(      wp_unslash( $_POST['email']            ?? '' ) );
    $callback_time    = sanitize_text_field( wp_unslash( $_POST['callback_time']    ?? '' ) );
    $date             = sanitize_text_field( wp_unslash( $_POST['date']             ?? '' ) ); // YYYY-MM-DD
    $slot             = sanitize_text_field( wp_unslash( $_POST['slot']             ?? '' ) ); // Morning | Afternoon
    $duration_minutes = intval(                          $_POST['duration_minutes'] ?? 0    );
    $zone             = sanitize_text_field( wp_unslash( $_POST['zone']             ?? '' ) );
    $postcode         = sanitize_text_field( wp_unslash( $_POST['postcode']         ?? '' ) );
    $area_name        = sanitize_text_field( wp_unslash( $_POST['area_name']        ?? '' ) );
    $area_display     = $area_name !== '' ? $area_name : '—';
    $appliances_raw   = wp_unslash(          $_POST['appliances']       ?? '' );
    $total            = intval(              $_POST['total']            ?? 0  );
    $terms_accepted   = ( $_POST['terms_accepted'] ?? '' ) === '1';
    $terms_display    = $terms_accepted ? 'Accepted at reservation' : 'NOT RECORDED';

    // Parse appliances JSON string (sent as-is from sessionStorage)
    $appliances = [];
    if ( $appliances_raw ) {
        $decoded = json_decode( $appliances_raw, true );
        if ( is_array( $decoded ) ) {
            $appliances = $decoded;
        }
    }


    // ── VALIDATE ─────────────────────────────────────────────────────────

    $required = [
        'first_name'    => $first_name,
        'last_name'     => $last_name,
        'phone'         => $phone,
        'email'         => $email,
        'callback_time' => $callback_time,
        'date'          => $date,
        'slot'          => $slot,
    ];

    foreach ( $required as $field => $value ) {
        if ( $value === '' ) {
            echo json_encode( [ 'success' => false, 'error' => "Missing required field: {$field}." ] );
            wp_die();
        }
    }

    if ( ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $date ) ) {
        echo json_encode( [ 'success' => false, 'error' => 'Invalid date format.' ] );
        wp_die();
    }

    if ( ! in_array( $slot, [ 'Morning', 'Afternoon' ], true ) ) {
        echo json_encode( [ 'success' => false, 'error' => 'Invalid slot value.' ] );
        wp_die();
    }

    // Use minimum duration if not set (skip route / inline Step 2 route)
    if ( $duration_minutes <= 0 ) {
        $duration_minutes = 60;
    }


    // ── MINIMUM NOTICE GUARD ───────────────────────────────────────
    //
    // Step 3 fetches availability once, on page load. A tab left open since
    // the morning will still submit happily in the evening against data that
    // has gone stale, and every check above this point tests only the SHAPE
    // of the date, never whether it is still reachable.
    //
    // Running the submitted slot back through loc_slot_is_free() — the same
    // function the calendar itself uses — means this can never drift from
    // what the customer was offered. No events are passed, so it tests just
    // the minimum-notice clamp and whether the job still fits the window.
    //
    // Deliberately NOT a double-booking check: that would need a full
    // calendar fetch on every submission. This closes one specific hole, a
    // booking written into the past.
    $window = ( strtolower( $slot ) === 'afternoon' ) ? [ '13:00', '18:00' ] : [ '07:00', '13:00' ];
    if ( ! loc_slot_is_free( $date, $window[0], $window[1], $duration_minutes, [] ) ) {
        echo json_encode( [
            'success' => false,
            'error'   => 'That slot is no longer available — it may have passed while this page was open. Please pick another date, or call me on 07710 649 360.',
        ] );
        wp_die();
    }


    // ── WRITE TO GOOGLE CALENDAR ──────────────────────────────────────────

    $booked = loc_create_provisional_booking(
        $date,
        strtolower( $slot ),           // 'morning' or 'afternoon'
        $first_name . ' ' . $last_name,
        $phone,
        $email,
        $appliances,
        $duration_minutes,
        $zone,
        $callback_time,
        $terms_accepted
    );

    if ( ! $booked ) {
        echo json_encode( [ 'success' => false, 'error' => 'Could not write to Google Calendar. Please try again or call me directly.' ] );
        wp_die();
    }

    // ── FORMAT SHARED VALUES ──────────────────────────────────────────────

    $date_obj       = DateTime::createFromFormat( 'Y-m-d', $date );
    $date_formatted = $date_obj ? $date_obj->format( 'l j F Y' ) : $date;

    $slot_display  = ( $slot === 'Morning' ) ? 'Morning (7am – 1pm)' : 'Afternoon (1pm – 6pm)';
    // Time only, for running inline in a sentence — "(Afternoon (1pm – 6pm))"
    // put brackets inside brackets. The full label still heads the summary.
    $slot_time     = ( $slot === 'Morning' ) ? '7am – 1pm' : '1pm – 6pm';

    $total_display = $total > 0 ? 'From £' . $total . ' — I\'ll confirm your exact price on the call' : 'To be discussed on the call';

    if ( ! empty( $appliances ) ) {
        $appliance_lines = '';
        foreach ( $appliances as $name => $price ) {
            $appliance_lines .= '  ' . $name . ' — £' . $price . "\n";
        }
        $appliance_lines = rtrim( $appliance_lines );
    } else {
        $appliance_lines = '  To be discussed on the call';
    }


    // ── NOTIFICATION EMAIL TO CHRIS ───────────────────────────────────────

    $notify_subject = 'RESERVATION — ' . $first_name . ' ' . $last_name . ' — ' . $date_formatted . ' — ' . $zone;
    $notify_body    = <<<EOT
NEW RESERVATION — ACTION REQUIRED
==================================

CALL THIS NUMBER:
{$phone}

----------------------------------
Customer:  {$first_name} {$last_name}
Email:     {$email}
----------------------------------
Date:      {$date_formatted}
Slot:      {$slot_display}
Zone:      {$zone}
Postcode:  {$postcode}
Area:      {$area_display}
Callback:  {$callback_time}
Terms:     {$terms_display}
----------------------------------
Appliances:
{$appliance_lines}

Total:     {$total_display}
Duration:  {$duration_minutes} min
----------------------------------

Call to confirm the reservation and arrange the £25 deposit by bank transfer.
EOT;

    wp_mail(
        'hello@leicesterovencleaning.co.uk',
        $notify_subject,
        $notify_body,
        [ 'Content-Type: text/plain; charset=UTF-8' ]
    );

    // ── CONFIRMATION EMAIL TO CUSTOMER ────────────────────────────────────

    // ── WHEN I'LL CALL ────────────────────────────────────────────────────
    //
    // Call at the next occurrence of the window the customer asked for,
    // counting from NOW rather than from tomorrow. Someone reserving at 9am
    // who wants a morning call gets one the same morning — waiting a full
    // day was losing the whole point of a callback preference.
    //
    // Two things override their preference, both because the job is close:
    //
    //   1. Job is today        -> within a couple of hours, whatever they picked.
    //   2. The call would roll -> first thing that morning, whatever they
    //      onto the job's own      picked, because any later window risks
    //      day                     ringing after I have already been.
    //
    // Rule 2 is what holds the invariant this logic exists to protect: the
    // promised call can never land after the job it is confirming. The
    // version before Sept 2026 rolled Fri/Sat/Sun to Monday and broke it.
    //
    // Windows: Morning 08:00-12:00, Afternoon 12:00-17:00, Evening 17:00-cutoff.
    $tz_london = new DateTimeZone( 'Europe/London' );
    $now       = new DateTime( 'now',   $tz_london );
    $today     = new DateTime( 'today', $tz_london );

    $callback_label = ucfirst( strtolower( trim( $callback_time ) ) );
    if ( ! in_array( $callback_label, [ 'Morning', 'Afternoon', 'Evening' ], true ) ) {
        $callback_label = 'Morning';
    }
    $callback_lower = strtolower( $callback_label );

    $window_end_hour = [
        'Morning'   => 12,
        'Afternoon' => 17,
        'Evening'   => LOC_CALL_CUTOFF_HOUR,
    ][ $callback_label ];

    // A "confirm on the call" booking has no agreed date, so the two
    // job-is-close overrides cannot apply — fall through to the window rule.
    $appt_date = DateTime::createFromFormat( 'Y-m-d', $date, $tz_london );
    $days_away = $appt_date ? (int) $today->diff( $appt_date )->days : null;

    $window_end  = ( clone $today )->setTime( $window_end_hour, 0 );
    $cutoff      = ( clone $today )->setTime( LOC_CALL_CUTOFF_HOUR, 0 );
    $calls_today = ( $now < $window_end && $now < $cutoff );

    // $call_when has to read naturally in two places — the email subject
    // ("I'll call ...") and mid-sentence in the body ("I'll give you a call
    // ... to confirm") — so it stays a short phrase. Anything extra goes in
    // $call_detail, which is appended as its own sentence in the body only.
    $call_detail = '';

    if ( $days_away === 0 ) {
        $call_when = 'within the next couple of hours';
    } elseif ( $calls_today ) {
        $call_when = 'this ' . $callback_lower;
    } elseif ( $days_away === 1 ) {
        $call_when   = 'first thing tomorrow morning';
        $call_detail = ' Your slot is tomorrow, so I\'ll ring early — from around ' . LOC_CALL_FIRST_THING . '.';
    } else {
        $call_when = 'tomorrow ' . $callback_lower;
    }

    $confirm_subject = 'Your slot is reserved, ' . $first_name . ' — I\'ll call ' . $call_when;
    $confirm_body    = <<<EOT
Hi {$first_name},

Thank you for reserving with me — your slot on {$date_formatted}, {$slot_time}, is held.

I'll give you a call {$call_when} to confirm your booking, run through your appliances, and answer anything you're not sure about.{$call_detail} Once we have spoken, I'll arrange a £25 deposit by bank transfer to officially lock it in.

Nothing to do on your end right now — I'll call you.

YOUR RESERVATION
{$date_formatted} — {$slot_display}

APPLIANCES
{$appliance_lines}

Total: {$total_display}

WHAT TO HAVE READY ON THE DAY
- Clear access to the oven(s)
- I clean the original trays, side racks and shelves that came with the oven — please take out any non-original trays or anything else stored inside before I arrive
- Access to water, which I need to complete the clean

If for any reason you need to reach me before I call, you can contact me on 07710 649 360 or hello@leicesterovencleaning.co.uk.

Leicester Oven Cleaning
hello@leicesterovencleaning.co.uk
EOT;

    wp_mail(
        $email,
        $confirm_subject,
        $confirm_body,
        [ 'Content-Type: text/plain; charset=UTF-8', 'Bcc: hello@leicesterovencleaning.co.uk' ]
    );


    // ── DONE ─────────────────────────────────────────────────────────────

    echo json_encode( [ 'success' => true ] );
    wp_die();
}

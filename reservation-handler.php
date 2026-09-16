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

    // Work out natural-language call timing
    $today     = new DateTime( 'today', new DateTimeZone( 'Europe/London' ) );
    $appt_date = new DateTime( $date, new DateTimeZone( 'Europe/London' ) );
    $days_away = (int) $today->diff( $appt_date )->days;

    $callback_lower = strtolower( $callback_time ?: 'morning' );

    // The confirmation call goes out the next day, WEEKENDS INCLUDED.
    //
    // This used to roll Fri/Sat/Sun forward to the following Monday, on the
    // assumption that no calls happened at a weekend. That promised a Monday
    // call for a Saturday or Sunday job reserved on the Friday or Saturday —
    // a call landing after the job had already been done, stated in the email
    // subject line. Weekends are the high-capacity days (all-day "Open: 2",
    // both windows open), so it fired often.
    //
    // Chris confirmed he calls at weekends, so there is no roll-forward at
    // all: same-day reservations get a call today, everything else tomorrow.
    // Because $days_away >= 1 in the else branch, "tomorrow" is always on or
    // before the appointment date — the promised call can no longer outlive
    // the booking it is confirming.
    if ( $days_away === 0 ) {
        $call_when = 'later today (' . $callback_lower . ')';
    } else {
        $call_when = 'tomorrow ' . $callback_lower;
    }

    $confirm_subject = 'Your slot is reserved, ' . $first_name . ' — I\'ll call ' . $call_when;
    $confirm_body    = <<<EOT
Hi {$first_name},

Thank you for reserving with me — your slot on {$date_formatted} ({$slot_display}) is held.

I'll give you a call {$call_when} to confirm your booking, run through your appliances, and answer anything you're not sure about. Once I've spoken, I'll arrange a £25 deposit by bank transfer to officially lock it in.

Nothing to do on your end right now — I'll come to you.

YOUR RESERVATION
{$date_formatted} — {$slot_display}

APPLIANCES
{$appliance_lines}

Total: {$total_display}

WHAT TO HAVE READY ON THE DAY
- Clear access to the oven(s) — please remove any trays, shelves, or items stored inside before I arrive
- Access to a cold water tap — and hot water where available

If you need to reach me before I call, you can contact me on 07710 649 360 or hello@leicesterovencleaning.co.uk.

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

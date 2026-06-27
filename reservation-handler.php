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
    $appliances_raw   = wp_unslash(          $_POST['appliances']       ?? '' );
    $total            = intval(              $_POST['total']            ?? 0  );

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
        $callback_time
    );

    if ( ! $booked ) {
        echo json_encode( [ 'success' => false, 'error' => 'Could not write to Google Calendar. Please try again or call us directly.' ] );
        wp_die();
    }

    // ── FORMAT SHARED VALUES ──────────────────────────────────────────────

    $date_obj       = DateTime::createFromFormat( 'Y-m-d', $date );
    $date_formatted = $date_obj ? $date_obj->format( 'l j F Y' ) : $date;

    $slot_display  = ( $slot === 'Morning' ) ? 'Morning (7am – 1pm)' : 'Afternoon (1pm – 6pm)';

    $total_display = $total > 0 ? '£' . $total . ' (fixed price)' : 'To be discussed on the call';

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
Callback:  {$callback_time}
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

    $confirm_subject = 'Your oven cleaning slot is reserved — ' . $date_formatted;
    $confirm_body    = <<<EOT
Hi {$first_name},

Your slot is provisionally held. Here's a summary of your reservation.

DATE AND TIME
{$date_formatted} — {$slot_display}

APPLIANCES
{$appliance_lines}

Total: {$total_display}

WHAT HAPPENS NEXT
We'll call you to confirm everything and arrange a £25 deposit by bank transfer.
No payment is due right now — no card details are needed.

WHAT TO HAVE READY ON THE DAY
- Clear access to the oven(s) — please remove any trays, shelves, or items stored inside before we arrive
- A cold water tap nearby

If you need to get in touch before we call, you can reach us at tel:PLACEHOLDER.

Thanks for choosing Leicester Oven Cleaning. We look forward to seeing you on {$date_formatted}.

Leicester Oven Cleaning
hello@leicesterovencleaning.co.uk
EOT;

    wp_mail(
        $email,
        $confirm_subject,
        $confirm_body,
        [
            'Content-Type: text/plain; charset=UTF-8',
            'From: Leicester Oven Cleaning <hello@leicesterovencleaning.co.uk>',
        ]
    );


    // ── DONE ─────────────────────────────────────────────────────────────

    echo json_encode( [ 'success' => true ] );
    wp_die();
}

<?php
/**
 * Leicester Oven Cleaning — Slot interest capture
 *
 * Defines loc_handle_slot_interest(), registered as a WordPress AJAX action
 * in functions.php and called from Step 3 when someone lands on a window
 * that has gone.
 *
 * WHY THIS EXISTS
 * ---------------
 * The calendar cannot currently tell the difference between "nobody wanted
 * that week" and "three people wanted a morning and gave up". Both look like
 * silence. While availability is deliberately thin, that silence is the one
 * number worth having: am I losing work to the gaps, or is demand genuinely
 * where I can already serve it?
 *
 * So when a window is full, the customer is offered a way to say what they
 * actually wanted. Two fields only — first name and a number — because the
 * friction is what loses the data in the first place.
 *
 * READ THE RESULTS AS A FLOOR, NEVER A TOTAL. Most people who cannot find a
 * slot simply close the tab. A low count means low form completion, not low
 * demand.
 *
 * THE PROMISE HAS TO BE REAL. This tells the customer they will hear if
 * something opens up. It stays honest only while the list is actually used —
 * if it ever becomes a data-collection exercise, take the feature out.
 */

// Where the countable log lives. Deliberately ABOVE the web root: it holds
// names and phone numbers, so it must not be web-servable and must never be
// committed to git. The email is the primary record — if this file cannot be
// written, the capture still succeeds.
if ( ! defined( 'LOC_INTEREST_LOG' ) ) {
	define( 'LOC_INTEREST_LOG', dirname( untrailingslashit( ABSPATH ) ) . '/loc-slot-interest.csv' );
}

function loc_handle_slot_interest() {
	header( 'Content-Type: application/json' );

	$name   = sanitize_text_field( wp_unslash( $_POST['name']   ?? '' ) );
	$phone  = sanitize_text_field( wp_unslash( $_POST['phone']  ?? '' ) );
	$window = sanitize_text_field( wp_unslash( $_POST['window'] ?? '' ) );
	$date   = sanitize_text_field( wp_unslash( $_POST['date']   ?? '' ) );
	$zone   = sanitize_text_field( wp_unslash( $_POST['zone']   ?? '' ) );
	$pc     = sanitize_text_field( wp_unslash( $_POST['postcode'] ?? '' ) );

	// Context: what the calendar was offering at that moment, which is what
	// makes a row interpretable later. Someone asking for a morning while
	// afternoons sat open all week wanted a MORNING. Someone asking when
	// nothing at all was bookable just wanted ANYTHING. Same tap, opposite
	// meanings, and only this tells them apart.
	//
	// Counted over the NEXT 14 DAYS, not the full 180-day lookahead. Almost
	// every date far out is free, so a whole-window count read "plenty was
	// available" on every row and discriminated nothing. Most people book
	// inside the week, so the fortnight is the number that carries meaning.
	//
	// The 180-day total sits beside it for exactly that contrast: "nothing in
	// the next fortnight, 150 dates free after it" is near-term scarcity,
	// which is a different problem from being booked solid.
	$open_14d_dates = max( 0, intval( $_POST['open_14d_dates'] ?? 0 ) );
	$open_14d_am    = max( 0, intval( $_POST['open_14d_am']    ?? 0 ) );
	$open_14d_pm    = max( 0, intval( $_POST['open_14d_pm']    ?? 0 ) );
	$open_total     = max( 0, intval( $_POST['open_total']     ?? 0 ) );

	// Which month they were browsing when they asked. Tapping a full slot
	// while looking at next month is a different request from doing it on
	// the current one.
	$viewing_month = sanitize_text_field( wp_unslash( $_POST['viewing_month'] ?? '' ) );
	if ( ! preg_match( '/^\d{4}-\d{2}$/', $viewing_month ) ) {
		$viewing_month = '';
	}

	if ( $name === '' || $phone === '' ) {
		echo json_encode( [ 'success' => false, 'error' => 'Please add your first name and a contact number.' ] );
		wp_die();
	}
	if ( ! in_array( $window, [ 'Morning', 'Afternoon' ], true ) ) {
		$window = 'Either';
	}

	$tz  = new DateTimeZone( 'Europe/London' );
	$now = new DateTime( 'now', $tz );

	$date_obj  = DateTime::createFromFormat( 'Y-m-d', $date, $tz );
	$date_nice = $date_obj ? $date_obj->format( 'l j F Y' ) : ( $date ?: 'no particular date' );

	// ── LOG (countable) ───────────────────────────────────────────────────
	$row = [
		$now->format( 'Y-m-d H:i' ),
		$date,
		$window,
		$viewing_month,
		$zone,
		$pc,
		$name,
		$phone,
		$open_14d_dates,
		$open_14d_am,
		$open_14d_pm,
		$open_total,
	];

	$logged = false;
	$log    = LOC_INTEREST_LOG;
	if ( ! file_exists( $log ) ) {
		// NB: changing these columns means old rows no longer line up. If it
		// ever happens again, move the existing file aside rather than
		// appending a different shape underneath the old header.
		$header = "logged_at,wanted_date,wanted_window,viewing_month,zone,postcode,first_name,phone,open_14d_dates,open_14d_mornings,open_14d_afternoons,open_180d_dates\n";
		$logged = ( false !== @file_put_contents( $log, $header, LOCK_EX ) );
	}
	$line = '';
	foreach ( $row as $cell ) {
		$line .= '"' . str_replace( '"', '""', (string) $cell ) . '",';
	}
	$line = rtrim( $line, ',' ) . "\n";
	$logged = ( false !== @file_put_contents( $log, $line, FILE_APPEND | LOCK_EX ) );

	// ── EMAIL (the record that cannot silently fail) ──────────────────────
	$subject = 'Slot wanted — ' . $window . ' on ' . ( $date_obj ? $date_obj->format( 'D j M' ) : 'any date' );

	$availability_note = $open_14d_dates === 0
		? 'NOTHING was bookable in the next 14 days when they asked.'
		: 'In the next 14 days: ' . $open_14d_dates . ' date(s) bookable — '
			. $open_14d_am . ' with a morning, ' . $open_14d_pm . ' with an afternoon.';

	$availability_note .= "\n" . $open_total . ' date(s) bookable across the whole 6 months.';
	if ( $open_14d_dates === 0 && $open_total > 0 ) {
		$availability_note .= "\n=> Near-term scarcity: there is plenty later, just nothing soon.";
	}
	if ( $viewing_month !== '' ) {
		$availability_note .= "\nThey were looking at " . $viewing_month . '.';
	}

	$body = <<<EOT
Someone hit a full window on Step 3 and asked to be told if it frees up.

WHAT THEY WANTED
{$window} on {$date_nice}

WHO
{$name} — {$phone}
Area: {$zone} ({$pc})

WHAT THEY COULD SEE AT THE TIME
{$availability_note}

Logged at {$now->format('D j M Y, H:i')}.

This is a waiting-list request, not a booking — nothing is held for them.
EOT;

	wp_mail(
		'hello@leicesterovencleaning.co.uk',
		$subject,
		$body,
		[ 'Content-Type: text/plain; charset=UTF-8' ]
	);

	echo json_encode( [ 'success' => true, 'logged' => $logged ] );
	wp_die();
}

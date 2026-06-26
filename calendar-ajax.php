<?php
/**
 * Leicester Oven Cleaning — Calendar AJAX endpoint
 *
 * Returns available slot data as JSON for a given zone and duration.
 * Called by loc_step3_script on page load via fetch().
 * Does not require WordPress.
 */

header( 'Content-Type: application/json' );

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/calendar-api.php';

$zone             = isset( $_GET['zone'] )             ? trim( $_GET['zone'] )             : '';
$duration_minutes = isset( $_GET['duration_minutes'] ) ? intval( $_GET['duration_minutes'] ) : 0;

if ( $zone === '' || $duration_minutes <= 0 ) {
    echo json_encode( [ 'error' => 'Missing or invalid parameters: zone and duration_minutes are required.' ] );
    exit;
}


$result = loc_get_available_slots( $zone, $duration_minutes, 180 );

if ( is_string( $result ) && strpos( $result, 'AUTH_REQUIRED:' ) === 0 ) {
    echo json_encode( [ 'error' => 'Calendar not authorised. Please complete the OAuth flow.' ] );
    exit;
}

echo json_encode( $result );
exit;

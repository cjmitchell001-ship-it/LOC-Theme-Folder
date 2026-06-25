<?php
/**
 * Leicester Oven Cleaning — Google Calendar OAuth endpoint
 *
 * One-time browser flow to authorise the Google Calendar API.
 * Visit this file directly in a browser to trigger authentication.
 * Once token.json is written this file is no longer needed for normal operation.
 *
 * Does not require WordPress — loads vendor autoload and calendar-api.php directly.
 */

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/calendar-api.php';

// Must match exactly what is registered in Google Cloud Console → Authorised redirect URIs
define( 'LOC_OAUTH_REDIRECT_URI', 'http://127.0.0.1:10004/wp-content/themes/leicester-oven-cleaning-child/calendar-auth.php' );

$client    = loc_get_google_client();
$tokenFile = __DIR__ . '/token.json';

$client->setRedirectUri( LOC_OAUTH_REDIRECT_URI );

if ( isset( $_GET['code'] ) ) {
    // Exchange authorisation code for access + refresh token
    $token = $client->fetchAccessTokenWithAuthCode( $_GET['code'] );

    if ( isset( $token['error'] ) ) {
        echo '<p style="font-family:sans-serif;color:red;">Error: ' . htmlspecialchars( $token['error_description'] ?? $token['error'] ) . '</p>';
        exit;
    }

    $client->setAccessToken( $token );
    file_put_contents( $tokenFile, json_encode( $token ) );

    echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Calendar Connected</title></head><body style="font-family:sans-serif;padding:2em;">';
    echo '<h2 style="color:#1A3A6E;">&#10003; Calendar connected successfully.</h2>';
    echo '<p>You can close this window.</p>';
    echo '<p style="color:#888;font-size:0.9em;">token.json has been saved to the theme folder.</p>';
    echo '</body></html>';
    exit;
}

// No code yet — redirect to Google consent screen
$authUrl = $client->createAuthUrl();
header( 'Location: ' . filter_var( $authUrl, FILTER_SANITIZE_URL ) );
exit;

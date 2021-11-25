<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once '../vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('156338303218-448d8r066aqn85kg7vksvu6qfhss05h4.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/Nobel_Laureate_Finder/php-gcp/home.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();

?>

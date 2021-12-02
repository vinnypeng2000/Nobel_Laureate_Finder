<?php
//Warning: session_start(): Cannot start session when headers already sent in /workspace/config.php on line 34 
//Warning: session_destroy(): Trying to destroy uninitialized session in /workspace/logout.php on line 17 
//Warning: Cannot modify header information - headers already sent by (output started at /workspace/logout.php:1) in /workspace/logout.php on line 22
//The above warning are triggered if there is an empty line above <?php tag at the start of the file.

error_reporting(E_ALL);
ini_set('display_errors', 1);

//logout.php

include('config.php');

//Reset OAuth access token
$google_client->revokeToken();

// $_SESSION['loggedin'] = false;

//Destroy entire session data.
session_destroy();

// echo "end";
//Warning: Cannot modify header information - headers already sent by (output started at /workspace/logout.php:22) in /workspace/logout.php on line 25
//This warning will be triggered if an echo command is placed.

//redirect page to index.php
header('Location: http://nobel-laureate-finder-332817.uk.r.appspot.com/home.php');
exit();

?>
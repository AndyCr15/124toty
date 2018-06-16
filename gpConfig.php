<?php

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = 'XXXXXXX.apps.googleusercontent.com';
$clientSecret = 'XXXXXXXX';
$redirectURL = 'http://124toty.androidandy.uk/login.php';
//$redirectURL = 'http://localhost:8080/boardgames/login.php';

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('aauk');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>

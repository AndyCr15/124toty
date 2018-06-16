<?php

include 'session.php'; 

//Include GP config file
include_once 'gpConfig.php';

//Unset token and user data from session
unset($_SESSION);
unset($_SESSION['token']);
unset($_SESSION['userData']);

setcookie("id", "", time() - 3600); 

//Reset OAuth access token
$gClient->revokeToken();

//Destroy entire session
session_destroy();

//Redirect to homepage
header("Location:login.php");
?>

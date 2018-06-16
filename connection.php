<?php

    $dbHost     = "localhost";
    $dbUsername = "androida_andyc";
    $dbPassword = "mYsqlp4ss.";
    $dbName     = "androida_toty";
    

	$link = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
	
	if (mysqli_connect_error()) {
		
		die("There was an error connecting to the database");
		
	}

?>

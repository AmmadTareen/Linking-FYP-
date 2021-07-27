<?php

	// Database Host Name
	$db_host='fdb30.awardspace.net'; 

	// Database User Name
	$db_user='3814061_linking'; 

	// Database Password
	$db_pass='Pa55w0rd001'; 

	// Database Name
	$db_name='3814061_linking';

	// Function that creates a connection 
	$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

	// If the Database does not connect
	if (!$conn) {
		// Prints all the errors that it produces
		die("Connection failed: ".mysqli_connect_error());
	}


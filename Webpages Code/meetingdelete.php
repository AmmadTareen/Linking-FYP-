<?php
	
	// Runs the session to get username
	session_start();

	// Laods the file that connects to the database
	require 'conn.php';

	// Saving the current users username
	$username = $_SESSION['username'];

	// Gets the Booking ID from the URL
	$bid = $_GET['bid'];

	// Query to delete the booking 
	$sql = "DELETE FROM professionalbooking WHERE ID='$bid'";
	// Exectes the Query 
	mysqli_query($conn, $sql);

	// Redirects the user to the main booking page
	header("location: timeslots");
	exit();
<?php
	session_start();

	// Loads the file that connects the database
	require 'conn.php';

	// Stores the Logged-in users username
	$username = $_SESSION['username'];

	// Stores the values that are present in the URL
	$id = $_GET['id'];
	$professional = $_GET['professional'];

	// SQL Query that Updates the Booking with the user who booked it and changes the Status to 1
	$sql = "UPDATE professionalbooking SET Cuser='$username', Status=1 WHERE ID = '$id'";
	$result = mysqli_query($conn, $sql);

	// Takes the user back to the Professional Profile page
	header("location: professionalprofile?username=".$professional."");
	exit();

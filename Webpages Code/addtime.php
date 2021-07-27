<?php

	session_start();

	// Loads the file that connects to the database
	require 'conn.php';

	// Stores the Logged-in users username
	$username = $_SESSION['username'];

	// Stores the input made by the user
	$time = $_POST['time'];
	$day = $_POST['day'];
	$statusadd = 0;

	// Making sure the time entered is between 00:00 & 24:00 in a 24hr Format
	if ($time >= '00:00' && $time <= '24:00') {
		// Making sure just days between Monday - Friday are added both lower and upper cases
		if ($day == 'monday' || $day == 'tuesday' || $day == 'wednesday' || $day == 'thursday' || $day == 'friday' || $day == 'Monday' || $day == 'Tuesday' || $day == 'Wednesday' || $day == 'Thursday' || $day == 'Friday') {

			// SQL Query to check whether the Booking already exists
			$sqlcheck = "SELECT * FROM professionalbooking WHERE Username= '$username' AND Meetingtime = '$time' AND Day='$day'";
			$resultcheck = mysqli_query($conn, $sqlcheck);

			// Checks the number of results 
			if(mysqli_num_rows($resultcheck) > 0){
				// Runs if there is a result
				// Sends an error in the URL
				header("location: timeslots?error=duplicate");
				exit();
			  // Runs if the booking does not exist
			} else {

				// Inserts the inputs to the table
				$sql = "INSERT INTO professionalbooking (Username, Meetingtime, Day) VALUES (?,?,?)";
				// Prepared Statement (for security reasons)
				$stmt = mysqli_stmt_init($conn);

				// Error catch, if the prepared statement doesnt work
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					// Changing the URL to help print error codes
					exit();
					header("location: timeslots?error=sqlerror");
				} else {
					// Binding variables to the prepared statement 
					mysqli_stmt_bind_param($stmt, "sss", $username, $time, $day,);
					// Executing the prepared statement
					mysqli_stmt_execute($stmt);

					// SQL Query that Sets the Status of the record created to 0, meaning that it has not been booked
					$sqlstat = "UPDATE professionalbooking SET Status=0 WHERE Day='$day' AND Meetingtime='$time'";
					$result = mysqli_query($conn, $sqlstat);

					// Success URL
					header("location: timeslots?success=timeadded");
					exit();

					}
				}
		  // Runs if the day entered is incorrect
		} else {
			header("location: timeslots?error=wrongday");
			exit();
		}
	  // Runs if the time entered is incorrect
	} else {
		header("location: timeslots?error=incorrecttime");
		exit();
	}
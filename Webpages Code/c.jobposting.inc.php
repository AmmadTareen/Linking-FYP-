<?php

// Checking to see if the Post Job button is clicked
if (isset($_POST['cjobposting'])) {
	
	// Loads the file to connect ot the database
	require 'conn.php';

	// Stores the inputs the user entered
	$username = $_POST['username'];
	$jobTitle = $_POST['jobTitle'];
	$jobDesc = $_POST['jobDesc'];
	$jobfield = $_POST['field'];

	// Checks to see if all the fields have been filled in 
	if (empty($jobTitle) || empty($jobDesc) || empty($jobfield)) {
		// Changing the URL to help print error codes
		header("location: c.index?error=emptyfields");
		exit();
	} else {
		// Checking to see if the user has already posted this job
		$sqlcheck = "SELECT * FROM jobposting WHERE Username= '$username' AND Jobname = '$jobTitle' AND Jobdesc = '$jobDesc' AND Jobfield='$jobfield'";
		$resultcheck = mysqli_query($conn, $sqlcheck);

		// Chcking to see the number of results 
		if (mysqli_num_rows($resultcheck) > 0){
			// Runs if the query returns a result 
			header("location: c.postajob?error=jobexists");
				exit();
		  // Runs if the query does not return a result
		} else {
			// SQL Query to insert the fields filled
			$sql = "INSERT INTO jobposting (Username, Jobname, Jobdesc, Jobfield, appstatus) VALUES(?,?,?,?,'0')";
			// Prepared Statement (for security reasons)
			$stmt = mysqli_stmt_init($conn);
			// Error catch, if the prepared statement doesnt work
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				// Changing the URL to help print error codes
				header("location: c.postajob?error=sqlerror");
				exit();
			} else {
				// Binds the Hashed password instead of password
				mysqli_stmt_bind_param($stmt, "ssss", $username, $jobTitle, $jobDesc, $jobfield);
				// Executing the prepared statement
				mysqli_stmt_execute($stmt);
				// Changing the URL to help print error codes
				header("location: c.postajob?success=formposted");
				exit();
			}
	}

	}
	// Closes the statements that were used for finding and writing to the database
	mysqli_stmt_close($stmt);
	// Closes the connection which is made in the conn.php
	mysqli_clsoe($conn);
  // if the button is not clicked
} else {
	header("location: c.index");
}

<?php

	session_start();
	
	// Loads the file that connects to the database
	require 'conn.php';

	// Saving the Logged-in users username
	$username = $_SESSION['username'];

	// Saving the inputs made by the user
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$phone = $_POST['phone'];

	if(isset($_POST['saveBtn'])){

		// SQL Query that inputs the data entered by the user
		$sql = "INSERT INTO personaldata (Username, Firstname, lastname, Phonenumber) VALUES (?, ?, ?, ?)";
		// Prepared Statement (for security reasons)
		$stmt = mysqli_stmt_init($conn);
		// Error catch, if the prepared statement doesnt work
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			// Changing the URL to help print error codes
			header("location: personalprofileupdate?error=sqlerror");
			exit();
		} else {
			// Binding variables to the prepared statement 
			// Binds the Hashed password instead of password
			mysqli_stmt_bind_param($stmt, "ssss", $username, $firstname, $lastname, $phone);
			// Executing the prepared statement
			mysqli_stmt_execute($stmt);
			// Changes the URL on a successful save
			header("location: profilesettings?success=saved");
			exit();
		} 
} 

if(isset($_POST['updateBtn'])){
	// SQL Query that saves the information enetered by the user if the entry has already been made
	$sqlupdate = "UPDATE personaldata SET Firstname = '$firstname', Lastname='$lastname', Phonenumber='$phone' WHERE Username='$username'";	
	$result = mysqli_query($conn,$sqlupdate);
	// Changing the URL when the upload is successful
	header("location: profilesettings?success=updated");
	exit();

}
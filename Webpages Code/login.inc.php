<?php

// Professional Login Logic

session_start();

// Checking to see if the Login button was pressed
if(isset($_POST['profLoginSubmit'])){
	require 'conn.php';

	// Grabbing the fields of data enetered by the user
	$username = $_POST['username'];
	$password = $_POST['password'];

	// Checking to see if both Fields were filled
	if (empty($username) || empty($password)) {
		header("location: Professionalloginform?error=emptyfields");
		exit();

	  // If both fields were filled run the following
	} else {

		// SQL Query to check of the user exists
		$query= "SELECT * FROM users WHERE Username= '$username'";
		$result = mysqli_query($conn, $query);

		// Checking to see the number of results
		if(mysqli_num_rows($result)> 0) {
			// Runs if there is a result (Cannot be more than 1 because usernames are always unique)
			while($row = mysqli_fetch_array($result)) {
				// As the Password is hashed, this chekcs to see if the users password is correct or not
				// Checking to see if the users password matches the password saved in the database
				$passwordCheck = password_verify($password, $row['Password']);
				// Results of the check
				if($passwordCheck == false) {
					// Reuturns false, whihc means the password does not match
					// Sending the user an error
					header("location: Professionalloginform?error=incorrectpassword");
					exit();
				} elseif($passwordCheck == true) {
					// Returns True, which means that the password entered is correct
					$_SESSION['username'] = $row['Username'];
					// Takes the user to Prfoessional Homepage
					header("location: index");
				}
			}
		  // Preventing users from accessing the website through the URL
		} else {
			header("location: Professionalloginform?error=invalidcredentials");
			exit();
		}


	}

}

<?php
	// Logic for the Customer Sign-up Page

	// If the Customer Sign-up Button is clicked
	if(isset($_POST['customerSubmit'])){

		// Loading the file that connects to the database
		require 'conn.php';

		// Grabbing all the fields that the user entered data into
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];

		// Checks to see if all the fields have been filled in 
		if(empty($username) || empty($email) || empty($password) || empty($password2)) {
			// Changing the URL to help print error codes
			header("location: Customersignupform?error=emptyfields&username=".$username."&email=".$email);
			exit();
		  // Checks for a valid email and a valid username
		} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
			// Changing the URL to help print error codes
			header("location: Customersignupform?error=invalidusername");
			exit();
		  // Checks for a valid email
		} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			// Changing the URL to help print error codes
			header("location: Customersignupform?error=invalidemail&username=".$username);
			exit();
		  // Checks for a valid username 
		} elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
			// Changing the URL to help print error codes
			header("location: Customersignupform?error=invalidusername&email=".$email);
			exit();
		  // Checks to see whether the two passwords match or not
		} elseif($password !== $password2) {
			// Changing the URL to help print error codes
			header("location: Customersignupform?error=passwordcheck&username&username=".$username."&email=".$email);
			exit();
		} else {
			// Checks to see if the Username already exists
			// Sql Query 
			$sql = "SELECT Username FROM Cusers WHERE username=?";
			// Prepared Statement (for security reasons)
			$stmt = mysqli_stmt_init($conn);
			// Error catch, if the prepared statement doesnt work
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				// Changing the URL to help print error codes
				header("location: Customersignupform?error=sqlerror");
				exit();
			} else {
				// Binding variables to the prepared statement 
				mysqli_stmt_bind_param($stmt, "s", $username);
				// Executing the prepared statement
				mysqli_stmt_execute($stmt);
				// Stroing the results
				mysqli_stmt_store_result($stmt);
				// Checks the number of rows that match the query 
				$resultCheck = mysqli_stmt_num_rows($stmt);
				// if Results > 0 it means that the username already exists
				if ($resultCheck > 0 ) {
					// Changing the URL to help print error codes
					header("location: Customersignupform?error=usernametaken&email=".$email);
				exit();
				} else {
					// Checks to see if the Email already exists
					// Is run once the username is found to be unique
					// Sql Query 
					$query = "SELECT Email FROM Cusers WHERE email=?";
					// Prepared Statement (for security reasons)
					$stmt = mysqli_stmt_init($conn);
					// Error catch, if the prepared statement doesnt work
					if (!mysqli_stmt_prepare($stmt, $query)) {
						// Changing the URL to help print error codes
						header("location: Customersignupform?error=sqlerror");
						exit();
					} else {
						// Binding variables to the prepared statement 
						mysqli_stmt_bind_param($stmt, "s", $email);
						// Executing the prepared statement
						mysqli_stmt_execute($stmt);
						// Stroing the results
						mysqli_stmt_store_result($stmt);
						// Checks the number of rows that match the query 
						$resultCheck = mysqli_stmt_num_rows($stmt);
						// if Results > 0 it means that the email already exists
						if ($resultCheck > 0 ) {
							// Changing the URL to help print error codes
							header("location: Customersignupform?error=emailtaken");
							exit();
						} else {
							// Username and Email are both unique
							// SQL Query to insert the fields filled
							$sql = "INSERT INTO Cusers (Username, Email, Password) VALUES(?, ?, ?)";
							// Prepared Statement (for security reasons)
							$stmt = mysqli_stmt_init($conn);
							// Error catch, if the prepared statement doesnt work
							if (!mysqli_stmt_prepare($stmt, $sql)) {
								// Changing the URL to help print error codes
								exit();
								header("location: Customersignupform?error=sqlerror");
							} else {
								// For extra security the password will be hashed
								// Variable to save the hashed password
								$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
								// Binding variables to the prepared statement
								// Binds the Hashed password instead of password
								mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);
								// Executing the prepared statement
								mysqli_stmt_execute($stmt);
								// Changing the URL to help print error codes
								header("location: Customersignedup");
								exit();
							}
						}	
					}
				}
			}
		}

	// Closes the stateme ts that were used for finding and writing to the database
	mysqli_stmt_close($stmt);
	// Closes the connection which is made in the conn.php
	mysqli_clsoe($conn);


   // If the Customer Sign-up Button is not clicked
} else {
	// Prevents the user from entering the Sign up form page without clicking the submit button
	header("location: Customersignupform");
	exit();
}









<?php
	// Logic for the Professional Sign-up Page

	// If the Professionl Sign-up Button is clicked
	if(isset($_POST['profSubmit'])){

		// Loading the file that connects to the database
		require 'conn.php';

		// Grabbing all the fields that the user entered data into
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];
		$field = $_POST['field'];

		// Checks to see if all the fields have been filled in 
		if(empty($username) || empty($email) || empty($password) || empty($password2) || empty($field)) {
			// Changing the URL to help print error codes
			header("location: Professionalsignupform?error=emptyfields&username=".$username."&email=".$email);
			exit();
		  // Checks for a valid email and a valid username
		} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
			// Changing the URL to help print error codes
			header("location: Professionalsignupform?error=invalidemailusername");
			exit();
		  // Checks for a valid email
		} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			// Changing the URL to help print error codes
			header("location: Professionalsignupform?error=invalidemail&username=".$username);
			exit();
		  // Checks for a valid username 
		} elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
			// Changing the URL to help print error codes
			header("location: Professionalsignupform?error=invalidusername&email=".$email);
			exit();
		  // Checks to see whether the two passwords match or not
		} elseif($password !== $password2) {
			// Changing the URL to help print error codes
			header("location: Professionalsignupform?error=passwordcheck&username&username=".$username."&email=".$email);
			exit();
		} else {
			// Checks to see if the Username already exists
			// Sql Query 
			$sql = "SELECT Username FROM users WHERE username=?";
			// Prepared Statement (for security reasons)
			$stmt = mysqli_stmt_init($conn);
			// Error catch, if the prepared statement doesnt work
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				// Changing the URL to help print error codes
				header("location: Professionalsignupform?error=sqlerror");
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
					header("location: Professionalsignupform?error=usernametaken");
				exit();
				} else {
					// Checks to see if the Email already exists
					// Is run once the username is found to be unique
					// Sql Query 
					$query = "SELECT Email FROM users WHERE email=?";
					// Prepared Statement (for security reasons)
					$stmt = mysqli_stmt_init($conn);
					// Error catch, if the prepared statement doesnt work
					if (!mysqli_stmt_prepare($stmt, $query)) {
						// Changing the URL to help print error codes
						header("location: Professionalsignupform?error=sqlerror");
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
							header("location: Professionalsignupform?error=emailtaken");
							exit();
						} else {
							// Username and Email are both unique
							// SQL Query to insert the fields filled
							$sql = "INSERT INTO users (Username, Email, Password, Field) VALUES(?, ?, ?, ?)";
							// Prepared Statement (for security reasons)
							$stmt = mysqli_stmt_init($conn);
							// Error catch, if the prepared statement doesnt work
							if (!mysqli_stmt_prepare($stmt, $sql)) {
								// Changing the URL to help print error codes
								exit();
								header("location: Professionalsignupform?error=sqlerror");
							} else {
								// For extra security the password will be hashed 
								// Variable to save the hashed password
								$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
								// Binding variables to the prepared statement 
								// Binds the Hashed password instead of password
								mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashedPassword, $field);
								// Executing the prepared statement
								mysqli_stmt_execute($stmt);

								$sqlImg = "SELECT * FROM users WHERE Username='$username'";
								$resultImg = mysqli_query($conn,$sqlImg);

								if(mysqli_num_rows($resultImg)> 0){
									while($row = mysqli_fetch_array($resultImg)) {
										$userID = $row['ID'];
										$sqlquery = "INSERT INTO profileImg (userID, status) VALUES ('$userID', 1)";
										mysqli_query($conn,$sqlquery);
										
										// Changing the URL to help print error codes
										header("location: Professionalsignedup");
										exit();
									}
								} else {
									echo "There was an error!";
								}
							}
						}	
					}
				}
			}
		}
	// Closes the statements that were used for finding and writing to the database
	mysqli_stmt_close($stmt);
	// Closes the connection which is made in the conn.php
	mysqli_clsoe($conn);

  // If the Professionl Sign-up Button is not clicked
} else {
	// Prevents the user from entering the Sign up form page without clicking the submit button
	header("location: Professionalsignupform");
	exit();
}





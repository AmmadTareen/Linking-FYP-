<?php
	
	// Loads the file that connects to the database 
	require 'conn.php';

	// Stores the ID from the URL
	$aid = $_GET['aid'];

	// SQL Query that searches the applicant table with the job ID from the URL
	$sql = "SELECT * FROM applicants WHERE ID = '$aid'";
	$result = mysqli_query($conn, $sql);

	// Checks the number of results 
	if (mysqli_num_rows($result) > 0){
		// Runs if the number of results is 1 or more
		while ($row = mysqli_fetch_array($result)){
			// Saves the Jobname
			$jname = $row['Jobname'];
		}

		// SQL Query that searches for the record with the jobname that was saved previosuly
		$sqljid = "SELECT * FROM jobposting WHERE Jobname = '$jname' ";
		$resultjid = mysqli_query($conn, $sqljid);

		// Checks the number of results 
		if (mysqli_num_rows($resultjid)){
			// Runs if the number of results is 1 or more
			while ($rowjid = mysqli_fetch_array($resultjid)) {
				// Stores the JobID
				$jid = $rowjid['ID'];

				// Deletes the applicant from the record
				$sqldel = "DELETE FROM applicants WHERE ID = '$aid'";

				mysqli_query($conn, $sqldel);

				// Takes the user back to the Job page
				header("location: applicant?jid=".$jid);
			}

		  // Runs if the jobposting table returns nothing
		} else {
			echo "An issue with the users Table";
		}
	  // Runs if the applicants table returns nothing
	} else {
		echo "An Error has occured";
	}


	
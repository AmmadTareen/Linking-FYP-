<?php
	
	// Loads the file that connects to the database
	require 'conn.php';

	// Saves the ID from the URL
	$aid = $_GET['aid'];

	// SQL Query that searches the applicants table with the ID from the URL
	$sql = "SELECT * FROM applicants WHERE ID = '$aid'";
	$result = mysqli_query($conn, $sql);

	// Checks the number of results
	if (mysqli_num_rows($result) > 0) {

		// Runs if the number of results is 1 or more
		while($row = mysqli_fetch_array($result)){
			// Stores the jobname
			$jname = $row['Jobname'];
			// Stores the Applicants name
			$applicantname = $row['Applicantname'];
		}

		// Updates the jobposting table with the applicant and changes the status to 1, which menas the job is now starting
		$sqlupdate = "UPDATE jobposting SET applicant='$applicantname', appstatus='1' WHERE Jobname = '$jname'";
		mysqli_query($conn,$sqlupdate);

		// Changing the URL
		header("location: jobsposted?success");
		exit();
	  // Runs if the Applicant table fails to output any results
	} else {
		echo "Applicant not found";
	}


?>

<?php
  session_start();
  $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Professional Homepaage</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="Linking.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
  <!-- Nav Bar -->
  <nav class="navbar">
    <!-- Text on the Left side -->
    <div id="textname" class="brand-title"><a href="index"style="color: black;"><strong> HOME </strong></a></div>
    <!-- Logo -->
     <a class="navbar-brand center" href="index">
      <img class= "navimg" src="Logo.png" alt="Logo" style="margin-left: 50%;">
      </a>
    <div class="navbar-links">
      <ul>
        <!-- Profile Button -->
        <li><button type="submit" name="profileBtn" onclick="location.href='Professionalprofilepage'" style="font-size: 15px; border-radius: 45px;" class="btn btn-outline-info justify-content-center profilenavBtn"> PROFILE </button></li>
        
        <!-- Logout Button -->
        <li><form action="logout.inc" method="post">
          <button type="submit" name="logoutBtn" style="border-radius: 45px; margin-left: 5px;" class="btn btn-outline-secondary"> Logout </button></form></li>  
      </ul>
    </div>
  </nav>

  <!-- Booking Page Button -->
  <center>
    <td> <a href='timeslots' target='_blank'> <button class='btn btn-outline-info justify-content-center' style="border-radius: 45px; margin-top: 0.5%; margin-right:1.5%;"> Booking Page </button></a> </td>
  </center>


  <!-- Search Bar -->
  <div class="search-bar">
    <!-- Search Bar Form -->
    <form action="search" method="POST">
        <input name="wordsearched" type="text" class="search_box" placeholder="Type to Search..">
        <button name="submit_search" style="border: none; background: none;">
        <a class="searchBtn" href="search">
        <!-- Search Icon -->
        <i class="fa fa-search"></i>
        </a>
        </button>
    </form>
  </div>


<div class="content">

	<?php
    // Checking to see if the user is logged-in
		if (isset($_SESSION['username'])) {
      // Prints if the user is logged in
			echo '<center> <h1 class="login-status">Welcome to Linking, '.$username.'</h1> </center>';
      echo '<div class="yesPrint">';

      // Prints if the user is not logged-in
		} else {

			echo '<center> <h1 class="login-status">Please log in to use the website</h1>'; 
      echo '<div class="noPrint">';
		
    }

	?> 

  <hr>

  <!-- Personal Training Boxes -->
  <div class="jobinfo">
  <?php

    // Loads the file that connects to the database 
    require 'conn.php';

    // SQL Query that finds 4 jobs from the "Personal Training" Field from the jobposting table
    $sql = "SELECT * FROM jobposting WHERE Jobfield= 'Personal Training' LIMIT 4";
    $result = $conn->query($sql);

    // Checks to see the number of results
    if ($result->num_rows > 0) {
        // Runs if the number of results is 1 or more

        // Prints a Header
        echo '<a href="alljobs?field=personal training"style="color: black; margin-left: 25%;"><strong> Personal Training: </strong></a>';
        // output data of each row
        while($row = $result->fetch_assoc()) {

            // Saves the Job Name
            $jobname = $row['Jobname'];
            // Printing data from the Database
            echo "<span> <div class='featuredBoxIndex' style='border-color:red; margin-top: 20px; margin-left: -4%;'>
              <br> <h4>Job: ". $jobname . "</h4> 
              <br> <h5>Description: ". $row["Jobdesc"] . "</h5>
              <br> <h6>Posted by: " . $row["Username"]. "</h6>
              <br>";

            // Loops to check whether the Job has been taken or the user has already applied
            // Is appstatus is 0 it means the job is still open
            if ($row['appstatus'] == 0 ){
              // If the job is open, we have to check whether the user has already applied for it
              $query = "SELECT * FROM applicants WHERE Jobname = '$jobname' AND Applicantname = '$username'";
              $results = mysqli_query($conn, $query);

                // Results if the user has already applied
                if (mysqli_num_rows($results) > 0 ){

                  echo "<center><h6 style='color:#32CD32;'> Applied </h6></center>";
                  // If the user has not already applied, print the apply button
                } else {
                echo "<center> <td> <a style='border-radius: 45px; margin-left: 5px;' href='apply?jid=".$row['ID']."'> <button type='button' class='btn btn-outline-info justify-content-center'>Apply</button></a> </center> </td>"; 
                }
              // If job is taken, print the user who has taken the job
            } else {
              echo "<h6> Applicant: ".$row['applicant'];
            } 
              echo "</div> ";
        }
      // If the number of results is 0
    } else {
        echo "No Results can be found at this time";
    }

    // Closes the connection to the database
    $conn->close();
    ?> 
  </div>

  <!-- IT Boxes -->
  <div class="jobinfo">
  <?php

    // Loads the file that connects to the database
    require 'conn.php';

    // SQL Query that finds 4 jobs from the "IT" Field from the jobposting table
    $sql = "SELECT * FROM jobposting WHERE Jobfield= 'IT' LIMIT 4";
    $result = $conn->query($sql);

    // Checks to see the number of results
    if ($result->num_rows > 0) {
        // Runs if the number of results is 1 or more

        // Prints a Header
        echo '<a href="alljobs?field=IT"style="color: black; margin-left: 45%;"><strong> IT: </strong></a>';
        // output data of each row
        while($row = $result->fetch_assoc()) {

           // Saves the Job Name
            $jobname = $row['Jobname'];
            // Printing data from the Database
            echo "<span> <div class='featuredBoxIndex' style='border-color:blue; margin-top: 20px; margin-left: -4%;'>
              <br> <h4>Job: ". $jobname . "</h4> 
              <br> <h5>Description: ". $row["Jobdesc"] . "</h5>
              <br> <h6>Posted by: " . $row["Username"]. "</h6>
              <br>";
            
            // Loops to check whether the Job has been taken or the user has already applied
            // Is appstatus is 0 it means the job is still open
            if ($row['appstatus'] == 0 ){
              // If the job is open, we have to check whether the user has already applied for it
              $query = "SELECT * FROM applicants WHERE Jobname = '$jobname' AND Applicantname = '$username'";
              $results = mysqli_query($conn, $query);

                // Results if the user has already applied
                if (mysqli_num_rows($results) > 0 ){

                  echo "<center><h6 style='color:#32CD32;'> Applied </h6></center>";
                  // If the user has not already applied, print the apply button
                } else {
                echo "<center> <td> <a style='border-radius: 45px; margin-left: 5px;' href='apply?jid=".$row['ID']."'> <button type='button' class='btn btn-outline-info justify-content-center'>Apply</button></a> </center> </td>"; 
                }
              // If job is taken, print the user who has taken the job
            } else {
              echo "<h6> Applicant: ".$row['applicant'];
            } 
              echo "</div> ";
        }
      // If the number of results is 0
    } else {
        echo "0 results";
    }

    // Closes the connection to the database
    $conn->close();
    ?> 

  </div>

  <!-- Law Boxes -->
  <div class="jobinfo">

  <?php

    // Loads the file that connects to the database
    require 'conn.php';

    // SQL Query that finds 4 jobs from the "Law" Field from the jobposting table
    $sql = "SELECT * FROM jobposting WHERE Jobfield= 'Law' LIMIT 4";
    $result = $conn->query($sql);

    // Checks to see the number of results
    if ($result->num_rows > 0) {
        // Runs if the number of results is 1 or more

        // Prints a Header
        echo '<a href="alljobs?field=Law"style="color: black; margin-left: 40%;"><strong> Law: </strong></a>';
        // output data of each row
        while($row = $result->fetch_assoc()) {
           
           // Saves the Job Name
            $jobname = $row['Jobname'];
            // Printing data from the Database
            echo "<span> <div class='featuredBoxIndex' style='border-color:black; margin-top: 20px; margin-left: -4%;'>
              <br> <h4>Job: ". $jobname . "</h4> 
              <br> <h5>Description: ". $row["Jobdesc"] . "</h5>
              <br> <h6>Posted by: " . $row["Username"]. "</h6>
              <br>";

            // Loops to check whether the Job has been taken or the user has already applied
            // Is appstatus is 0 it means the job is still open
            if ($row['appstatus'] == 0 ){
              // If the job is open, we have to check whether the user has already applied for it
              $query = "SELECT * FROM applicants WHERE Jobname = '$jobname' AND Applicantname = '$username'";
              $results = mysqli_query($conn, $query);

                // Results if the user has already applied
                if (mysqli_num_rows($results) > 0 ){

                  echo "<center><h6 style='color:#32CD32;'> Applied </h6></center>";
                  // If the user has not already applied, print the apply button
                } else {
                echo "<center> <td> <a style='border-radius: 45px; margin-left: 5px;' href='apply?jid=".$row['ID']."'> <button type='button' class='btn btn-outline-info justify-content-center'>Apply</button></a> </center> </td>"; 
                }
              // If job is taken, print the user who has taken the job
            } else {
              echo "<h6> Applicant: ".$row['applicant'];
            } 
              echo "</div> ";
        }
    } else {
        echo "0 results";
    }

    // Closes the connection to the database
    $conn->close();
    ?> 

  </div>

  <br>

  <!-- Medicine Boxes -->
  <div class="jobinfo">
  <?php

    // Loads the file that connects to the database
    require 'conn.php';

    // SQL Query that finds 4 jobs from the "Medicine" Field from the jobposting table
    $sql = "SELECT * FROM jobposting WHERE Jobfield= 'Medicine'  LIMIT 4";
    $result = $conn->query($sql);

    // Checks to see the number of results
    if ($result->num_rows > 0) {
        // Runs if the number of results is 1 or more

        // Prints a Header
        echo '<a href="alljobs?field=Medicine"style="color: black; margin-left: 35%;"><strong> Medicine: </strong></a>';

        // output data of each row
        while($row = $result->fetch_assoc()) {
            
            // Saves the Job Name
            $jobname = $row['Jobname'];
            // Printing data from the Database
            echo "<span> <div class='featuredBoxIndex' style='border-color:green; margin-top: 20px; margin-left: -4%;'>
              <br> <h4>Job: ". $jobname . "</h4> 
              <br> <h5>Description: ". $row["Jobdesc"] . "</h5>
              <br> <h6>Posted by: " . $row["Username"]. "</h6>
              <br>";

            // Loops to check whether the Job has been taken or the user has already applied
            // Is appstatus is 0 it means the job is still open
            if ($row['appstatus'] == 0 ){
              // If the job is open, we have to check whether the user has already applied for it
              $query = "SELECT * FROM applicants WHERE Jobname = '$jobname' AND Applicantname = '$username'";
              $results = mysqli_query($conn, $query);

                // Results if the user has already applied
                if (mysqli_num_rows($results) > 0 ){

                  echo "<center><h6 style='color:#32CD32;'> Applied </h6></center>";

                  // If the user has not already applied, print the apply button
                } else {
                echo "<center> <td> <a style='border-radius: 45px; margin-left: 5px;' href='apply?jid=".$row['ID']."'> <button type='button' class='btn btn-outline-info justify-content-center'>Apply</button></a> </center> </td>"; 
                }
              // If job is taken, print the user who has taken the job
            } else {
              echo "<h6> Applicant: ".$row['applicant'];
            } 
              echo "</div> ";
        }
    } else {
        echo "0 results";
    }
    
    // Closes the connection to the database
    $conn->close();
    ?>  
  </div>

</div>


</body>
</html>


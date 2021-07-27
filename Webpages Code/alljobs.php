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
    <div id="textname" class="brand-title"><a href="index"style="color: black;"><strong> < </strong></a></div>
     <!-- Logo -->
     <a class="navbar-brand center" href="index">
      <img class= "navimg" src="Logo.png" alt="Logo" style="margin-left: 50%;">
      </a>
    <div class="navbar-links">
      <ul>

        <!-- Profile Button -->
        <li><button type="submit" name="profileBtn" onclick="location.href='Professionalprofilepage'" style="font-size: 15px; border-radius: 45px;" class="btn btn-outline-info justify-content-center profilenavBtn"> PROFILE </button></li>
        
        <!-- Logout Button -->
        <li><form action="logout.inc" method="post"> <button type="submit" name="logoutBtn" style="border-radius: 45px; margin-left: 5px;" class="btn btn-outline-secondary"> Logout </button></form></li>  
      </ul>
    </div>
  </nav>
<br>
<br>


<!-- Profile Titles -->
<h5 class="joblist" style="margin-left: 20%; color: red;"> Job Name: </h5>
<h5 class="joblist" style="margin-left: 5%;"> Description: </h5>
<h5 class="joblist" style="margin-left: 5%; color: green;"> Posted by: </h5>

<?php

  // Loads the file that connects to the database
  require 'conn.php';

  // Saves the field from the URL
  $field = $_GET['field'];

  // SQL Query that searches for all the Jobs in the field from the URL
  $sql = "SELECT * FROM jobposting WHERE Jobfield = '$field'";
  $result = mysqli_query($conn, $sql);

  // Checks the number of results
  if (mysqli_num_rows($result) > 0){

    // Runs if the number of results is 1 or more
    while($row = mysqli_fetch_array($result)){
      // Saves the Job Name
        $jobname = $row['Jobname'];
        // Printing data from the Database
        echo "<div class='jobBoxes2'>
          <h5 class='joblist' style='color: red;'>" .$row['Jobname']."</h5>
          <h5 class='joblist' style='color: black;'>".$row['Jobdesc']."</h5>
          <h5 class='joblist' style='color: green;'>".$row['Username']."</h5>";

        // Loops to check whether the Job has been taken or the user has already applied
        // Is appstatus is 0 it means the job is still open
        if ($row['appstatus'] == 0 ){
          // If the job is open, we have to check whether the user has already applied for it
          $query = "SELECT * FROM applicants WHERE Jobname = '$jobname' AND Applicantname = '$username'";
          $results = mysqli_query($conn, $query);

            // Results if the user has already applied
            if (mysqli_num_rows($results) > 0 ){
              echo "<h5 style='float: right; margin-top: 1%; margin-right:2%; color:#32CD32;'> Applied </h5>";
              // If the user has not already applied, print the apply button
            } else {
            echo "<td class='joblist'> <a style='border-radius: 45px; float: right; margin-right: 10px; margin-top: 1%;' href='apply?jid=".$row['ID']."'> <button type='button' class='btn btn-outline-info justify-content-center'>Apply</button></a> </td>"; 
            }
          // If job is taken, print the user who has taken the job
        } else {
          echo "<h6 class='joblist' style='float: right; margin-top: 0.5%;'> Job taken by: ".$row['applicant']."</h6>";
        } 
          echo "</div> ";
    }

  // Runs if the SQL Query gives no results
} else {
    echo "0 results";
}
?>
<br>

</body>
</html>


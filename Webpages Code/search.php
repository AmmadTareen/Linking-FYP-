<?php  
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search Page</title>

    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="Linking.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script src="https://platform.linkedin.com/badges/js/profile.js" async defer type="text/javascript"></script>
   <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=20909201060&autoLogAppEvents=1" nonce="AYwfmgZk"></script>

</head>
<body>
  <!-- Nav Bar -->
  <nav class="navbar">
    <!-- Text on the left side -->
    <div id="textname" class="brand-title"><a href="index"style="font-size: 20px;color: black;"><strong> HOME </strong></a></div>
     <!-- Logo -->
     <a class="navbar-brand center" href="index">
      <img class= "navimg" src="Logo.png" alt="Logo">
      </a>
    <div class="navbar-links">
      <ul>

        <!-- Profile Button -->
        <li><button type="submit" name="profileBtn" onclick="location.href='Professionalprofilepage'" style="font-size: 15px; border-radius: 45px;" class="btn btn-outline-info justify-content-center profilenavBtn"> PROFILE </button></li>

        <!-- Logout Button -->
        <li><form action="logout.inc" method="post"> <button type="submit" name="logoutBtn" style="font-size: 15px;border-radius: 45px; margin-left: 5px;" class="btn btn-outline-secondary logoutnavBtn"> Logout </button></form></li>  
      </ul>
    </div>
  </nav>


<br>

  

<?php

  // Load the file that connects to the database
  require 'conn.php';

  // Saves the user currently Logged in 
  $username = $_SESSION['username'];

  
  if (isset($_POST['submit_search'])) {
    // Prevents SQL Injection / Security purposes
    $search = mysqli_real_escape_string($conn, $_POST['wordsearched']);

    // SQL Query 
    $sqlsearch = "SELECT * FROM jobposting WHERE Jobname LIKE '%$search%' OR Jobdesc LIKE '%$search%' OR Jobfield LIKE '%$search%'";

    // Creating the result variable
    $result = mysqli_query($conn,$sqlsearch);

    // Stores the number of results recieved
    $numResult = mysqli_num_rows($result);

    // Printing the number of search results
    if ($numResult <= 0 ){
      echo "There are ".$numResult." Results";
    } elseif ($numResult <= 1) {
      echo "There is ".$numResult." Result";
    } else {
      echo "There are ".$numResult." Results";
    }

    echo "<p>";

    // Checks number of rows in the Result Variable, should always be greater than 0 if the query is correct
    if ($numResult > 0 ) {
      // Runs if the number of results is 1 or more
      while($row = mysqli_fetch_array($result)){
        // Saves the Job Name
            $jobname = $row['Jobname'];
            // Printing data from the Database
            echo "<span> <div class='featuredBoxIndex' style='display: inline-block; border-color:blue; margin-top: 20px; margin-left: 0%;'>
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
      // Runs if the number of results is 0
    } else {
      // When no results are found / Search Query is does not exist
      echo "There are no results matching your query";
    }
  }
?>



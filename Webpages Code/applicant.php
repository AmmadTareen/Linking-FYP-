<?php  
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Jobs Posted</title>

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
    <!-- Text on the Left side -->
    <div id="textname" class="brand-title"><a href="c.index"style="font-size: 20px;color: black;"><strong> HOME </strong></a></div>
     <!-- Logo -->
     <a class="navbar-brand center" href="c.index">
      <img class= "navimg" src="Logo.png" alt="Logo">
      </a>
    <div class="navbar-links">
      <ul>

        <!-- Profile Button -->
        <li><button type="submit" name="profileBtn" onclick="location.href='Customerprofilepage'" style="font-size: 15px; border-radius: 45px; background-color: #5bc0de; color: white;" class="btn btn-outline-info justify-content-center profilenavBtn"> PROFILE </button></li>
        
        <!-- Logout Button -->
        <li><form action="logout.inc" method="post"> <button type="submit" name="logoutBtn" style="font-size: 15px;border-radius: 45px; margin-left: 5px;" class="btn btn-outline-secondary logoutnavBtn"> Logout </button></form></li>  
      </ul>
    </div>
  </nav>

  <!-- Profile Titles -->
  <h1 class="profileTitles"><a href="Customerprofilepage"style="color: black;"> Profile Page </a></h1>
  <h1 class="profileTitles"><a href="jobsposted"style="color: #5bc0de;"> Jobs Posted </a></h1>
  <h1 class="profileTitles"><a href="meetings" style="color: black;"> Meetings </a></h1>

  <br>
  <br>
  <br>

  <?php

    // Loads the file that connects to the database
    require 'conn.php';

    // Saves the ID from the URL
    $user = $_GET['jid'];

    // SQL Query that searches for the job that associates with the ID
    $sql  = "SELECT * FROM jobposting WHERE ID = '$user'";
    $result = mysqli_query($conn, $sql);

    // Checks the number of results
    if (mysqli_num_rows($result) > 0){
      // Runs if the number of results is 1 or more
      while($row = mysqli_fetch_array($result)) {
        // Prints the data
        echo " <center> <span>  <div class='featuredBox3' style='border-color:yellow;'>
          <br> <h5 style='margin-top: 5%;'> Job: ". $row["Jobname"] . "</h5>
          <br> <h5> Description: ". $row['Jobdesc'] . " </h5>
        </div> </span> </center>";
        // Stores the Jobname
        $jname = $row['Jobname'];
      }

    // SQL Query that gets all the applicants associated with the jobname
    $sqlapp = "SELECT * FROM applicants WHERE Jobname = '$jname'";
    $results = mysqli_query($conn, $sqlapp);

    // Checks the number of results 
    if (mysqli_num_rows($results) > 0){
      // Runs if the number of results is 1 or more
      while($rows = mysqli_fetch_array($results)){
        // Prints the data
        echo "<hr> <center>
        <center><td> <a style='color: black; font-size: 25px;' href='professionalprofile?username=".$rows['Applicantname']."' target='_blank'> ".$rows['Applicantname']."`s Profile </button></a> </td> </center>
        <br>
        <td> <a href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> <button class='btn btn-outline-info justify-content-center'> Zoom Meeting </button></a> </td> 
        <br>
        <td> <a style='margin-top: 1%;' href='approveapplicant?aid=".$rows['ID']."<button type='button' class='btn btn-outline-info justify-content-center'> Yes </button></a> </td>
        <td> <a style='margin-top: 1%;' href='removeapplicant?aid=".$rows['ID']."<button type='button' class='btn btn-outline-info justify-content-center'> No </button></a> </td>
        </center>";
      }
      // Runs if the Applicants table results in a 0
    } else {
      echo "There are no applicants for this job";
    }
      // Runs if the Jobposting table results in a 0
    } else {
      echo "This Job does not exist";
    }


?>
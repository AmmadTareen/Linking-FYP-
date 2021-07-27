<?php
  session_start();
  $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Customer Home</title>

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

</head>
<body>
  <!-- Nav Bar -->
  <nav class="navbar">
    <!-- Text on the Left side -->
    <div id="textname" class="brand-title"><a href="c.postajob"style="color: black;"><strong> HOME </strong></a></div>
     <!-- Logo -->
     <a class="navbar-brand center" href="c.index">
      <img class= "navimg" src="Logo.png" alt="Logo">
      </a>
    <div class="navbar-links">
      <ul>

        <!-- Profile Button -->
        <li><button href="#" type="submit" name="profileBtn" onclick="location.href='Customerprofilepage'" class="btn btn-outline-info justify-content-center" style="border-radius: 45px;"> PROFILE </button></li>
        
        <!-- Logout Button -->
        <li><form action="logout.inc" method="post"> <button type="submit" name="logoutBtn" style="border-radius: 45px; margin-left: 5px;" class="btn btn-outline-secondary"> Logout </button></form></li>  
      </ul>
    </div>
  </nav>

  <!-- Job Post Button -->
  <button id="postBtn" class="btn btn-outline-info justify-content-center" style="border-radius: 45px; margin-left: 48%; margin-top: 1%;"onclick="location.href='c.postajob'">Post a Job</button> 
  <br>
  <br>

 <!-- Search Bar -->
 <div class="c-search-bar">
    <form action="c.search" method="POST">
        <input name="wordsearched" type="text" class="search_box" placeholder="Search for a Professional or Field..">
        <button name="submit_search" style="border: none; background: none;">
        <a class="searchBtn" href="search">
        <!-- Search Icon -->
        <i class="fa fa-search"></i>
        </a>
        </button>
    </form>
  </div>


<div class="content">

  <!-- Checking whether a user is Logged-in or not -->
  <?php

    if (isset($_SESSION['username'])) {
      // Runs if the user is logged-in 
      echo '<center> <h1 class="login-status"> Welcome to Linking, '.$username.' </h1> </center>';
      echo "<div class='yesPrint'>";

    } else {
      // Runs if the user is not logged-in 
      echo '<center> <h1 class="login-status"> Please Log in to use the website </h1> </center>';
      echo "<div class='noPrint'>";
    
    }

  ?>

  <hr>
  <h3 style="color: black; margin-left: 2%;">New Users: </h3>
  <br>

  <!-- Prinitng out the 2 newest Users-->
  <?php

    // Loading the file to connect to the database
    require 'conn.php';

    // Query that searches for the 2 latest users in the database
    $sql = "SELECT * FROM users ORDER BY ID DESC LIMIT 3";
    $result = mysqli_query($conn, $sql);

    // Printing the results of the query
    while($row = mysqli_fetch_array($result)) {
        // Saving the ID number of the users
        $profid = $row['ID'];
       echo "<div class='featuredBox1'> 
          <center>";

          // SQL Query to find out whether the user has a Profile Picture or not
          $sqlimg = "SELECT * FROM profileImg WHERE userID = '$profid'";
          $resultimg = mysqli_query($conn, $sqlimg);
          // Printing the results from the profileImg database
          while($rowimg = mysqli_fetch_array($resultimg)){
            // Prints if the user does not have a Profile Picture
            if($rowimg['status'] ==1 ){
              echo "<img src='uploads/profile.jpg' class='iconImg'>";
              // Prints if the user does have a Profile Picture
            } else {
              echo "<img src='uploads/profile".$row['ID'].".jpg' class='iconImg'>";
            }
          }
          echo "<br>
          <br>
          <h4> Username: <a style='color: black;' href='professionalprofile?username=".$row['Username']."' target='_blank'> <u>".$row['Username']. "</u></a></h4>
          <h4><a style='color: blue;'href='mailto:'".$row['Email'].">".$row['Email']."</a></h4>
          <h4>Field: ".$row['Field']."</h4>
          </center> </div>";
    }

  ?>
<br>



  <hr>

  <!-- Printing out 2 latest Jobs that were Posted -->
  <h3 style="color: black; margin-left: 2%;">Latest Jobs Posted: </h3>
  <br>

  <?php

    // Loads the file that connects to the database 
    require 'conn.php';

    // SQL Query that fetches the 2 latest jobs posted on the website
    $sql = "SELECT * FROM jobposting ORDER BY ID DESC LIMIT 2";
    $result = mysqli_query($conn, $sql);

    // Output the results
    while($row = mysqli_fetch_array($result)) {
      // Printing the Job data
      echo "<div class='featuredBox2' style='display: inline-block'>
            <div class='article-container'> 
            <br> <center> <h4>Job: ". $row["Jobname"] . "</h4> </center>
            <br> <h5>Description: ". $row["Jobdesc"] . "<h5>
            <br> <h6>Field: ". $row["Jobfield"] . "</h6>
            <br> <center><h6>Posted by: " . $row["Username"]. "</h6> </center>
            </div> </div>";
    }

  ?>

<br>

<hr>

<!-- Printing 2 jobs that were posted by the Logged-in user -->
<h3><a href="jobsposted"style="color: black; margin-left: 2%;"> Posted by Me: </a></h3>
  <?php

    // Loads the file that connects to the database 
    require 'conn.php';

    // SQL Query that fetches the 2 latest jobs posted by the Logged-in user
    $sql = "SELECT * FROM jobposting WHERE Username='$username' LIMIT 2";
    $result = mysqli_query($conn, $sql);

    // Output the results
    while($row = mysqli_fetch_array($result)) {
      // Printing the Job data
      echo "<div class='featuredBox2' style='display: inline-block'>
            <div class='article-container'> 
            <br> <center> <h4>Job: ". $row["Jobname"] . "</h4> </center>
            <br> <h5>Description: ". $row["Jobdesc"] . "<h5>
            <br> <h6>Field: ". $row["Jobfield"] . "</h6>
            <br> <center><h6>Posted by: " . $row["Username"]. "</h6> </center>
            </div> </div>";
    }

  ?>

  </div>



</body>
</html>


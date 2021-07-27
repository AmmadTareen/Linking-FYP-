<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Meetings</title>

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

    <!-- Professional Titles -->
    <h1 class="profileTitles"><a href="Customerprofilepage"style="color: black;"> Profile Page </a></h1>
    <h1 class="profileTitles"><a href="jobsposted"style="color: black;"> Jobs Posted </a></h1>
    <h1 class="profileTitles"><a href="meetings" style="color: #5bc0de;"> Meetings </a></h1>

  <br>

  <center><h4> Meetings booked by you </h4></center>


  <!-- Monday Boxes -->
  <div class="jobinfo">
  <?php
    
    // Stores the Logged-in users username
    $username = $_SESSION['username'];

    // Loads the file that connects to the database
    require 'conn.php';

    // SQL Query searching for the username from the session AND the day specified 
    $sql = "SELECT * FROM professionalbooking WHERE Cuser = '$username' AND Day='monday'";
    $result = mysqli_query($conn, $sql);

    // Prints the header with the day
    echo "<center><h4><u> Monday </u></h4></center>";

    // Checks the number of results 
    if(mysqli_num_rows($result)>0){

      // Runs if the number of results is 1 or more
      while($row = mysqli_fetch_array($result)){
        // Prints data
        echo "<center>
            <div class='timebox2'style='color: black'>
            <h6 class='joblist' style='margin-top: 1%; margin-left: 0.5%;'> Time: ".$row['Meetingtime']."</h6>
            <br>
            <a style='color: black;' href='professionalprofile?username=".$row['Username']."' target='_blank'> <h6 class='joblist' style='margin-top: 1%; margin-left: 0.5%;'> Professional: <u>".$row['Username']."</u></h6> </a>

            ";

            // If the Status is 1 this will run
            if ($row['Status'] == 1) {

                  echo "<td> <a href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> <button class='btn btn-outline-info justify-content-center'> Zoom Meeting </button></a> </td>
                ";
            }

            // Prints the Cancle Button
            echo "<td> <a href='cmeetingdelete?bid=".$row['ID']."'> <button id='deleteBtn' class='btn btn btn-outline-info justify-content-center'> Cancel </button></a> </td>
            
                  </div> </center>";
      }
      // Prints if the professionalbooking table shows no results
    } else {
      echo "<center>
          <p> You have not added any booking times </p>
          </center>";
    }

  ?>
  </div>

  <!-- Tuesday Boxes -->
  <div class="jobinfo">
  <?php
    
    // Stores the Logged-in users username
    $username = $_SESSION['username'];

    // Loads the file that connects to the database
    require 'conn.php';

    // SQL Query searching for the username from the session AND the day specified 
    $sql = "SELECT * FROM professionalbooking WHERE Cuser = '$username' AND Day='Tuesday'";
    $result = mysqli_query($conn, $sql);

    // Prints the header with the day
    echo "<center><h4><u> Tuesday </u></h4></center>";

    // Checks the number of results 
    if(mysqli_num_rows($result)>0){

      // Runs if the number of results is 1 or more
      while($row = mysqli_fetch_array($result)){
        // Prints data
        echo "<center>
            <div class='timebox2'style='color: black'>
            <h6 class='joblist' style='margin-top: 1%; margin-left: 0.5%;'> Time: ".$row['Meetingtime']."</h6>
            <br>
            <a style='color: black;' href='professionalprofile?username=".$row['Username']."' target='_blank'> <h6 class='joblist' style='margin-top: 1%; margin-left: 0.5%;'> Professional: <u>".$row['Username']."</u></h6> </a>";

            // If the Status is 1 this will run
            if ($row['Status'] == 1) {

                  echo "<td> <a href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> <button class='btn btn-outline-info justify-content-center'> Zoom Meeting </button></a> </td>
                ";
            }

          // Prints the Cancle Button
          echo "<td> <a href='cmeetingdelete?bid=".$row['ID']."'> <button id='deleteBtn' class='btn btn btn-outline-info justify-content-center'> Cancel </button></a> </td>
          
                </div> </center>";
      }
      // Prints if the professionalbooking table shows no results
    } else {
      echo "<center>
          <p> You have not added any booking times </p>
          </center>";
    }

  ?>
  </div>


  <!-- Wednesday Boxes -->
  <div class="jobinfo">
  <?php
    
    // Stores the Logged-in users username
    $username = $_SESSION['username'];

    // Loads the file that connects to the database
    require 'conn.php';

    // SQL Query searching for the username from the session AND the day specified 
    $sql = "SELECT * FROM professionalbooking WHERE Cuser = '$username' AND Day='Wednesday'";
    $result = mysqli_query($conn, $sql);

    // Prints the header with the day
    echo "<center><h4><u> Wednesday </u></h4></center>";

    // Checks the number of results 
    if(mysqli_num_rows($result)>0){

      // Runs if the number of results is 1 or more
      while($row = mysqli_fetch_array($result)){
        // Prints data
        echo "<center>
            <div class='timebox2'style='color: black'>
            <h6 class='joblist' style='margin-top: 1%; margin-left: 0.5%;'> Time: ".$row['Meetingtime']."</h6>
            <br>
            <a style='color: black;' href='professionalprofile?username=".$row['Username']."' target='_blank'> <h6 class='joblist' style='margin-top: 1%; margin-left: 0.5%;'> Professional: <u>".$row['Username']."</u></h6> </a>";

            // If the Status is 1 this will run
            if ($row['Status'] == 1) {

                  echo "<td> <a href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> <button class='btn btn-outline-info justify-content-center'> Zoom Meeting </button></a> </td>
                ";
            }

          // Prints the Cancle Button
          echo "<td> <a href='cmeetingdelete?bid=".$row['ID']."'> <button id='deleteBtn' class='btn btn btn-outline-info justify-content-center'> Cancel </button></a> </td>
          
                </div> </center>";
      }
      // Prints if the professionalbooking table shows no results
    } else {
      echo "<center>
          <p> You have not added any booking times </p>
          </center>";
    }

  ?>
  </div>


  <!-- Thursday Boxes -->
  <div class="jobinfo">
  <?php
    
    // Stores the Logged-in users username
    $username = $_SESSION['username'];

    // Loads the file that connects to the database
    require 'conn.php';

    // SQL Query searching for the username from the session AND the day specified 
    $sql = "SELECT * FROM professionalbooking WHERE Cuser = '$username' AND Day='Thursday'";
    $result = mysqli_query($conn, $sql);

    // Prints the header with the day
    echo "<center><h4><u> Thursday </u></h4></center>";

    // Checks the number of results 
    if(mysqli_num_rows($result)>0){

      // Runs if the number of results is 1 or more
      while($row = mysqli_fetch_array($result)){
        // Prints data
        echo "<center>
            <div class='timebox2'style='color: black'>
            <h6 class='joblist' style='margin-top: 1%; margin-left: 0.5%;'> Time: ".$row['Meetingtime']."</h6>
            <br>
            <a style='color: black;' href='professionalprofile?username=".$row['Username']."' target='_blank'> <h6 class='joblist' style='margin-top: 1%; margin-left: 0.5%;'> Professional: <u>".$row['Username']."</u></h6> </a>";

            // If the Status is 1 this will run
            if ($row['Status'] == 1) {

                  echo "<td> <a href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> <button class='btn btn-outline-info justify-content-center'> Zoom Meeting </button></a> </td>
                ";
            }

          // Prints the Cancle Button
          echo "<td> <a href='cmeetingdelete?bid=".$row['ID']."'> <button id='deleteBtn' class='btn btn btn-outline-info justify-content-center'> Cancel </button></a> </td>
          
                </div> </center>";
      }
      // Prints if the professionalbooking table shows no results
    } else {
      echo "<center>
          <p> You have not added any booking times </p>
          </center>";
    }

  ?>
  </div>


  <!-- Friday Boxes -->
  <div class="jobinfo">
  <?php
    
    // Stores the Logged-in users username
    $username = $_SESSION['username'];

    // Loads the file that connects to the database
    require 'conn.php';

    // SQL Query searching for the username from the session AND the day specified 
    $sql = "SELECT * FROM professionalbooking WHERE Cuser = '$username' AND Day='Friday'";
    $result = mysqli_query($conn, $sql);

    // Prints the header with the day
    echo "<center><h4><u> Friday </u></h4></center>";

    // Checks the number of results 
    if(mysqli_num_rows($result)>0){

      // Runs if the number of results is 1 or more
      while($row = mysqli_fetch_array($result)){
        // Prints data
        echo "<center>
            <div class='timebox2'style='color: black'>
            <h6 class='joblist' style='margin-top: 1%; margin-left: 0.5%;'> Time: ".$row['Meetingtime']."</h6>
            <br>
            <a style='color: black;' href='professionalprofile?username=".$row['Username']."' target='_blank'> <h6 class='joblist' style='margin-top: 1%; margin-left: 0.5%;'> Professional: <u>".$row['Username']."</u></h6> </a>";

            // If the Status is 1 this will run
            if ($row['Status'] == 1) {

                  echo "<td> <a href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> <button class='btn btn-outline-info justify-content-center'> Zoom Meeting </button></a> </td>
                ";
            }

          // Prints the Cancle Button
          echo "<td> <a href='cmeetingdelete?bid=".$row['ID']."'> <button id='deleteBtn' class='btn btn btn-outline-info justify-content-center'> Cancel </button></a> </td>
          
                </div> </center>";
      }
      // Prints if the professionalbooking table shows no results
    } else {
      echo "<center>
          <p> You have not added any booking times </p>
          </center>";
    }

  ?>
  </div>





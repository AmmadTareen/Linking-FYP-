<?php  
  session_start();
  $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Professional Profile</title>

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
        <li><button type="submit" name="profileBtn" onclick="location.href='Customerprofilepage'" style="font-size: 15px; border-radius: 45px;" class="btn btn-outline-info justify-content-center profilenavBtn"> PROFILE </button></li>

        <!-- Logout Button -->
        <li><form action="logout.inc" method="post"> <button type="submit" name="logoutBtn" style="font-size: 15px;border-radius: 45px; margin-left: 5px;" class="btn btn-outline-secondary logoutnavBtn"> Logout </button></form></li>  
      </ul>
    </div>
  </nav>


  <br>

  <?php

    // Loads the file that connects to the database
    require 'conn.php';

    // Saves the username from the URL
    $professional = $_GET['username'];

    // SQL Query that searches for the user with the username from the URL
    $sql = "SELECT * FROM users WHERE username = '$professional'";
    $result = mysqli_query($conn, $sql);

    // Checks the number of results 
    if (mysqli_num_rows($result) > 0){
      // Runs if the number of results is 1 or more
      while ($row = mysqli_fetch_array($result)) {
        // Stores the ID of the username
        $professionalID = $row['ID'];

        // SQL Query that searches for the ID of the user in the ProfileImg table from the previous tables ID
        $sqlimg = "SELECT * FROM profileImg WHERE userID = '$professionalID'";
        $resultImg = mysqli_query($conn, $sqlimg);

        // Outputs the results
        while($rowImg = mysqli_fetch_array($resultImg)) {
              // Prints the data 
              echo "<div>";
                // Status = 0 means the user has updated their profile 
                if ($rowImg['status'] == 0 ){
                  // Prints their profile picture
                  echo "<img src='uploads/profile".$professionalID.".jpg' class='iconImg' style='margin-left: 2%;'>";
                  // Status = 1
                } else {
                  // Prints the default profile picture
                  echo "<img src='uploads/profile.jpg' class='iconImg' style='margin-left: 2%;'>";
                }
              echo "</div>";
            }

        // SQL Query fetching the rest of the users data 
        $sqldetails = "SELECT * FROM personaldata WHERE Username = '$professional'";
        $resultdetails = mysqli_query($conn, $sqldetails);

        // Checks the number of results
        if(mysqli_num_rows($resultdetails) > 0){
          // Runs if the number of results are 1 or more
          while($rowdetails = mysqli_fetch_array($resultdetails)){
            // Prints data 
            echo "<br> <h6>".$rowdetails['Firstname']."</h6>
              <h6>".$rowdetails['Lastname']."</h6>
            ";
          }
          // If the number of results is 0
        } else{
          echo "The User has not updated their Profile";
        }
        
      } 
     // No results from the users table
    }else {
        echo "SQL Error";
      }

  ?>

<br>
<br>

<!-- Monday Boxes -->
<div class="jobinfo">
<?php
  
  // Loads the file that connects to the database
  require 'conn.php';
  // SQL Query searching for the username from the URL AND the day specified 
  $sql = "SELECT * FROM professionalbooking WHERE Username = '$professional' AND Day='monday'";
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
          <br>";
          // Status 0 means that no-one has booked the meeting
          if ($row['Status'] == 0) {
            
            echo "<h6 class='joblist' style='margin-left: 0.5%;'> Booking Available</h6>

                <td> <a href='makebooking?id=".$row['ID']."&professional=".$professional."'> <button class='btn btn-outline-info justify-content-center'> Book Meeting </button></a> </td>";

              // Status 1 means someone has booked the meeting and only prints if the user Logged-in and the user who has booked the meeting are the same
            } elseif ($row['Status'] == 1 && $username == $row['Cuser']) {
              echo "<h6 class='joblist' style='margin-left: 0.5%;'> This is your booking.</h6>
                
                <br>

                <td> <a href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> <button class='btn btn-outline-info justify-content-center'> Zoom Meeting </button></a> </td>
              ";
            // Prints if the Logged-in user and the user who booked the meeting are not the same
          } else {
            echo "<br> 
                    <h6> Booking Taken </h6>";
          }

        echo "</div> </center>";
    }
    // Prints if the professionalbooking table shows no results
  } else {
    echo "<center>
        <p> No Bookings for this day </p>
        </center>";
  }

?>
</div>

<!-- Tuesday Boxes -->
<div class="jobinfo">
<?php
  
  // Loads the file that connects to the database
  require 'conn.php';
  // SQL Query searching for the username from the URL AND the day specified 
  $sql = "SELECT * FROM professionalbooking WHERE Username = '$professional' AND Day='tuesday'";
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
          <br>";
          // Status 0 means that no-one has booked the meeting
          if ($row['Status'] == 0) {
            
              echo "<h6 class='joblist' style='margin-left: 0.5%;'> Booking Available</h6>

                <td> <a href='makebooking?id=".$row['ID']."&professional=".$professional."'> <button class='btn btn-outline-info justify-content-center'> Book Meeting </button></a> </td>";

              // Status 1 means someone has booked the meeting and only prints if the user Logged-in and the user who has booked the meeting are the same
            } elseif ($row['Status'] == 1 && $username == $row['Cuser']) {
              echo "<h6 class='joblist' style='margin-left: 0.5%;'> This is your booking.</h6>
                
                <br>

                <td> <a href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> <button class='btn btn-outline-info justify-content-center'> Zoom Meeting </button></a> </td>
              ";
            // Prints if the Logged-in user and the user who booked the meeting are not the same
          } else {
            echo "<br> 
                    <h6> Booking Taken </h6>";
          }

        echo "</div> </center>";
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
  
  // Loads the file that connects to the database
  require 'conn.php';
  // SQL Query searching for the username from the URL AND the day specified 
  $sql = "SELECT * FROM professionalbooking WHERE Username = '$professional' AND Day='Wednesday'";
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
          <br>";
          // Status 0 means that no-one has booked the meeting
          if ($row['Status'] == 0) {
            
            echo "<h6 class='joblist' style='margin-left: 0.5%;'> Booking Available</h6>

                <td> <a href='makebooking?id=".$row['ID']."&professional=".$professional."'> <button class='btn btn-outline-info justify-content-center'> Book Meeting </button></a> </td>";

              // Status 1 means someone has booked the meeting and only prints if the user Logged-in and the user who has booked the meeting are the same
            } elseif ($row['Status'] == 1 && $username == $row['Cuser']) {
              echo "<h6 class='joblist' style='margin-left: 0.5%;'> This is your booking.</h6>
                
                <br>

                <td> <a href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> <button class='btn btn-outline-info justify-content-center'> Zoom Meeting </button></a> </td>
              ";
            // Prints if the Logged-in user and the user who booked the meeting are not the same
          } else {
            echo "<br> 
                    <h6> Booking Taken </h6>";
          }

        echo "</div> </center>";
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
  
  // Loads the file that connects to the database
  require 'conn.php';
  // SQL Query searching for the username from the URL AND the day specified 
  $sql = "SELECT * FROM professionalbooking WHERE Username = '$professional' AND Day='Thursday'";
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
          <br>";
          // Status 0 means that no-one has booked the meeting
          if ($row['Status'] == 0) {
            
            echo "<h6 class='joblist' style='margin-left: 0.5%;'> Booking Available</h6>

                <td> <a href='makebooking?id=".$row['ID']."&professional=".$professional."'> <button class='btn btn-outline-info justify-content-center'> Book Meeting </button></a> </td>";

              // Status 1 means someone has booked the meeting and only prints if the user Logged-in and the user who has booked the meeting are the same
            } elseif ($row['Status'] == 1 && $username == $row['Cuser']) {
              echo "<h6 class='joblist' style='margin-left: 0.5%;'> This is your booking.</h6>
                
                <br>

                <td> <a href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> <button class='btn btn-outline-info justify-content-center'> Zoom Meeting </button></a> </td>
              ";
            // Prints if the Logged-in user and the user who booked the meeting are not the same
          } else {
            echo "<br> 
                    <h6> Booking Taken </h6>";
          }

        echo "</div> </center>";
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
  
  // Loads the file that connects to the database
  require 'conn.php';
  // SQL Query searching for the username from the URL AND the day specified 
  $sql = "SELECT * FROM professionalbooking WHERE Username = '$professional' AND Day='Friday'";
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
          <br>";
          // Status 0 means that no-one has booked the meeting
          if ($row['Status'] == 0) {
            
            echo "<h6 class='joblist' style='margin-left: 0.5%;'> Booking Available</h6>

                <td> <a href='makebooking?id=".$row['ID']."&professional=".$professional."'> <button class='btn btn-outline-info justify-content-center'> Book Meeting </button></a> </td>";
                
              // Status 1 means someone has booked the meeting and only prints if the user Logged-in and the user who has booked the meeting are the same
            } elseif ($row['Status'] == 1 && $username == $row['Cuser']) {
              echo "<h6 class='joblist' style='margin-left: 0.5%;'> This is your booking.</h6>
                
                <br>

                <td> <a href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> <button class='btn btn-outline-info justify-content-center'> Zoom Meeting </button></a> </td>
              ";
            // Prints if the Logged-in user and the user who booked the meeting are not the same
          } else {
            echo "<br> 
                    <h6> Booking Taken </h6>";
          }

        echo "</div> </center>";
    }
    // Prints if the professionalbooking table shows no results
  } else {
    echo "<center>
        <p> You have not added any booking times </p>
        </center>";
  }

?>
</div>

</body>
</html>
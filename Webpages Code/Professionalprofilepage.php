<?php
  session_start();
  // Saves the logged-in users username
  $username = $_SESSION['username'];
?>

<!-- Professional Profile Page for Professionals -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Professional Profile Page</title>

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
    <div id="textname" class="brand-title"><a href="index"style="color: black;"><strong> HOME </strong></a></div>
     <!-- Logo -->
     <a class="navbar-brand center" href="index">
      <img class= "navimg" src="Logo.png" alt="Logo">
      </a>
    <div class="navbar-links">
      <ul>

        <!-- Profile Button -->
        <li><button type="submit" name="profileBtn" onclick="location.href='Professionalprofilepage'" style="font-size: 15px; border-radius: 45px; background-color: #5bc0de; color: white;" class="btn btn-outline-info justify-content-center profilenavBtn"> PROFILE </button></li>

        <!-- Logout Button -->
        <li><form action="logout.inc" method="post">
          <button type="submit" name="logoutBtn" style="font-size: 15px;border-radius: 45px; margin-left: 5px;" class="btn btn-outline-secondary logoutnavBtn"> Logout </button></form></li>  
      </ul>
    </div>
  </nav>

    <!-- Page Titles -->
    <h2 class="profileTitles"><a href="Professionalprofilepage"style="color: #5bc0de;"> Profile Page </a></h2>
    <h2 class="profileTitles"><a href="mywork"style="color: black;"> My Work </a></h2>
    <h2 class="profileTitles"><a href="profilesettings"style="color: black;"> Update Profile </a></h2>

    <!-- Cover Photo -->
    <img class= "profileImg" src="photo.png" alt="Coverphoto">
    <br>
    <br>

    <?php

      // Loads the file that connects the database
      require 'conn.php';

      // SQL Query to fetch the users personal data
      $sql = "SELECT * FROM personaldata WHERE Username ='$username'";
      $result = mysqli_query($conn, $sql);

      // Checks to see the number of results
      if (mysqli_num_rows($result)> 0) {
        // Runs if results are 1 or more 
        while($row = mysqli_fetch_array($result)){
          // Saving the users first name
          $Firstname = $row['Firstname'];
          // Prints the div
          echo "<div class='yesPrint'>";
        }
        // If the number of results is 0 (User has not updated their profile)
      } else {
        echo '<center><h3> Welcome '.$username.' </h3></center>';
        echo '<br> <center><h4> Please add some data to your profile </h4></center>';
        // Does not print the following div
        echo "<div class='noPrint'>";
      }

    ?>

    <!-- What Prints if the user has updated their Profile -->
    <?php

    // Loads the file that connects to the database
    require 'conn.php';

    // SQL Query that selects the ID of the user that is logged in
    $sql = "SELECT ID FROM users WHERE Username ='$username'";
    $result = mysqli_query($conn, $sql);

    // Checks to see the number of resutls
    if (mysqli_num_rows($result)> 0) {
      // Runs if the number of results is 1 or more 
      while($row = mysqli_fetch_array($result)){
          // Saves the ID of the user logged-in
          $id = $row['ID'];

          // SQL Query that searches through the profileImg for the users record
          $sqlImg = "SELECT * FROM profileImg WHERE userID = '$id'";
          $resultImg = mysqli_query($conn,$sqlImg);

          // Output the results
          while($rowImg = mysqli_fetch_array($resultImg)) {
            echo "<center><div>";
              // Status= 0 means that the user has uploaded a Profile Picture
              if ($rowImg['status'] == 0 ){
                // Prints the users Profile Picture
                echo "<img src='uploads/profile".$id.".jpg' class='iconImg' style='margin-left: 2%;'>";
                // If Status = 1
              } else {
                // Prints the default Profile Picture
                echo "<img src='uploads/profile.jpg' class='iconImg' style='margin-left: 2%;'>";
              }
            echo "</div> </center>";
          }
      }

    }

    ?>

    <br>
    <!-- Prints the data of the user -->
    <center> <h3> <?php echo 'Welcome '.$Firstname ?> </h3> </center>

  </body>
  </html>
  

   






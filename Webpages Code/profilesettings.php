<?php
  session_start();
  $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update Profile</title>

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
    <div id="textname" class="brand-title"><a href="index"style="color: black;"><strong> HOME </strong></a></div>
     <!-- Logo -->
     <a class="navbar-brand center" href="index">
      <img class= "navimg" src="Logo.png" alt="Logo">
      </a>
    <div class="navbar-links">
      <ul>

        <!-- Profile Button -->
        <li><button href="#" type="submit" name="profileBtn" onclick="location.href='Professionalprofilepage'" class="btn btn-outline-info justify-content-center" style="border-radius: 45px; background-color: #5bc0de; color: white;"> PROFILE </button></li>

        <!-- Logout Button -->
        <li><form action="logout.inc" method="post">
          <button type="submit" name="logoutBtn" style="border-radius: 45px; margin-left: 5px; color: black;" class="btn btn-outline-secondary"> Logout </button></form></li>  
      </ul>
    </div>
  </nav>

    <!-- Profile Titles -->
    <h2 class="profileTitles"><a href="Professionalprofilepage"style="color: black;"> Profile Page </a></h2>
    <h2 class="profileTitles"><a href="mywork"style="color: black;"> My Work </a></h2>
    <h2 class="profileTitles"><a href="profilesettings"style="color: #5bc0de;"> Update Profile </a></h2>
    <br>
    <br>

    <!-- Booking Page Button -->
    <center>
      <td> <a href='timeslots' target='_blank'> <button class='btn btn-outline-info justify-content-center' style="border-radius: 45px;"> Booking Page </button></a> </td>
    </center>
    <br>
    <br>

    <!-- Printing the users Profile Picture -->
    <?php

    // Loads the file that connects the database
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
            echo "</div>";
          }
          // Caption
          echo "<p style='margin-left: 2%;'> We only accept JPG files </p>";
          // Upload and save buttons
          echo "<form action='upload' method='POST' style='margin-left: 2%; margin-top: -2%;' enctype='multipart/form-data'>
             <br>
             <input type='file' name='file'>
             <button type='submit' name='submit'>Upload</button>
             </form> </center>";
      }

    } else {
      echo 'You are not logged in';
    }

    // Fetching the logged-in users profile data
    $sqlvar = "SELECT * FROM personaldata WHERE Username = '$username'";
    $resultvar = mysqli_query($conn, $sqlvar);

    // Saves the number of results in the variable
    $numrows = mysqli_num_rows($resultvar);

    // Outputs the data from the previous SQL Query search
    while($rowvar = mysqli_fetch_array($resultvar)){
      // Saves the data found in variables
      // These variables are used to fill in the fields of the form if they have values present
      $firstname = $rowvar['Firstname'];
      $lastname = $rowvar['Lastname'];
      $phone = $rowvar['Phonenumber'];
    }

    ?>



<br>

<!-- Personal Information Box-->
<center>
<button id="collapisbleBtn" type="button" class="collapsibleInfoBox"> <strong> Personal Information </strong></button>
<div id="profileInfo" class="noPrint">
  <div class="profileInfo">
    <form action="personalprofilesave">
      <br>
      <label for="firstname"><b>First Name:</b></label>
      <br>
      <input type="text" name="firstname" value= <?php echo $firstname; ?> Firstname required>
      <br>
      <br>
      <label for="lastname"><b>Last Name:</b></label>
      <br>
      <input type="text" name="lastname" value= <?php echo $lastname; ?> LastName required>
      <br>
      <br>
      <label for="phonenumber"><b>Phone Number:</b></label>
      <br>
      <input type="tel" name="phone" pattern="+[0-9]{2}-[0-9]{4}[0-9]{5}" value= <?php echo $phone; ?> +44-000123415 required>
      <br>
      <small>Format: +(Area Code)-1234-56789</small>
      <br>
      <br>
      <?php
        // If the number of rows is greater than 1
        if ($numrows > 0 ){
          // There is already data present, hence printing the Update button
          echo '<button name="updateBtn" formmethod="post" style="margin-top: -5%;" class="btn btn-outline-info justify-content-center" id="updateBtn" type="submit"> Update </button>';
          // Prints if there are no results
        } else {
          echo '<button name="saveBtn" formmethod="post" style="margin-top: -5%;" class="btn btn-outline-info justify-content-center" type="submit"> Save </button>';
        }

      ?>
      <br>
    </form>
  </div>
</div>
</center>

<br>
<br>


<script type="text/javascript">

  // When the "Personal Information" box is clicked
  document.getElementById("collapisbleBtn").onclick = function() {openfunction()};


  // "Personal Information" box function
  function openfunction() {
    // Gets the classname of the text held in the box
    profileinfoclass = document.getElementById("profileInfo").className;

    // if the classname is preventing prinitng 
    if (profileinfoclass == "noPrint") {
      // Print the text
      document.getElementById("profileInfo").className = 'yesPrint';
      // Highlight the box
      document.getElementById("collapisbleBtn").className = "collapseactive";

      // Scrolls to the section that has just been printed / Scrolls a little down to where the boxes start
      var elmnt = document.getElementById("profileInfo");
      elmnt.scrollIntoView();

      // if the classname is prinitng
    } else {
        // Stop the words from prinitng 
        document.getElementById("profileInfo").className = 'noPrint';
        // Unhighlight the box
        document.getElementById("collapisbleBtn").className = "collapsibleInfoBox";
    }
  }
</script>

</body>
</html>
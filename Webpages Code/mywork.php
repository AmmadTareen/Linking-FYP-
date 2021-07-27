<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Work</title>

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
    <!-- The Words on the Left side -->
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

    <!-- Headings on the page -->  
    <h2 class="profileTitles"><a href="Professionalprofilepage"style="color: black;"> Profile Page </a></h2>
    <h2 class="profileTitles"><a href="mywork"style="color: #5bc0de;"> My Work </a></h2>
    <h2 class="profileTitles"><a href="profilesettings"style="color: black;"> Update Profile </a></h2>
    

    <center>
      <td> <a href='index'> <button class='btn btn-outline-info justify-content-center' style="border-radius: 45px; margin-top: 0.5%; margin-right:1.5%;">Apply for more Jobs </button></a> </td>
    </center>



<!-- Prints the Verticle Boxes -->
<?php
  
  // Loads the file that connects to the database
  require 'conn.php';

  // Where the logged-in users username is stored
  $username = $_SESSION['username'];

  // SQL Query to fetch the job related data for the logged-in user
  $sql = "SELECT * FROM jobposting WHERE applicant = '$username'";  
  $result = mysqli_query($conn, $sql);

  // Checking the number of results found
  if (mysqli_num_rows($result) > 0) {
    // Runs if there are 1 or more results
    while($row = mysqli_fetch_array($result)){
          // Displays the box with data
          echo "<div class='jobBoxes2'>
          <h5 class='joblist'>Job: ". $row["Jobname"] . "</h5>
          <h5 class='joblist'>Field: ". $row["Jobfield"] . "</h5>
          <h5 class='joblist'> Posted by: ". $row['Username'] . "</h5>
          

          <td> <a style='border-radius: 45px; margin-top: 1%; float: right; margin-right: 5%;' href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'><button class='btn btn-outline-info justify-content-center'> Zoom Meeting </button></a> </td>
          </div>";
    }
    
    // Prints if there are 0 results
  } else {
    echo "<center> <h4 style='margin-top:5%;'> You have not been selected for any jobs </h4> </center>";
  }

?>



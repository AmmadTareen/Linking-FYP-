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

  <!-- Professional Titles -->
  <h1 class="profileTitles"><a href="Customerprofilepage"style="color: black;"> Profile Page </a></h1>
  <h1 class="profileTitles"><a href="jobsposted"style="color: #5bc0de;"> Jobs Posted </a></h1>
  <h1 class="profileTitles"><a href="meetings" style="color: black;"> Meetings </a></h1>

  <br>
  <br>
  <br>

  <!-- The Modal -->
  <div id="postpop-up" class="modal1">

    <!-- Modal content -->
    <div class="modal-content">
    <span class="close" onclick="location.href='jobsposted'">&times;</span>
    <?php
      // Loads the database connection File
      require 'conn.php';

      // Gets the ID from the URL
      $user = $_GET['jid'];

      // SQL Query that searches the job with the ID that is fetched from the URL
      $sql  = "SELECT * FROM jobposting WHERE ID = '$user'";
      
      // Error catch, if the prepared statement doesnt work
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: jobposted?error=sqlerror");
      }

      // Creating the result variable
      $result = mysqli_query($conn, $sql);

      // Checks number of rows in the Result Variable, should always be greater than 0 if the query is correct
      if (mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_array($result)){

          //Saves the Applicant name in the Username Variable
          $username = $row['applicant'];
        }

        // Second SQL Query, to get the Applicants Information 
        $query = "SELECT ID, Username, Email FROM users WHERE Username = '$username'";

        // Creating the resultapp variable
        $resultapp = mysqli_query($conn, $query);

        // Checks number of rows in the Result Variable, should alwats be above 0 if the query is correct
        if (mysqli_num_rows($resultapp) > 0){
          while($row = $resultapp->fetch_assoc()) {
            echo "<span> <div class='centeralisefields'
              <center>
              <img src='uploads/profile".$row['ID'].".jpg' class='iconImg'>
              <br>
              <br>
              <br> <h4>Username: ".$row['Username']."</h4> 
              <br> <h4><a href='mailto:'".$row['Email'].">".$row['Email']."</a></h4>
              </center>
              <br> </div> </span>";
          }
        } else {
          // Prints if no applicant is found
          echo "There is no applicant For this job";
        }

      } else {
        // Prints if the there is an issue with the $user variable
        echo "There was a problem with the URL";
      }

      ?>
    </div>
  </div>




</body>
</html>
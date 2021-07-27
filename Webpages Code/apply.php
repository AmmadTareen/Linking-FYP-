<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Application</title>

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
    <!-- Tex on the Left side -->
    <div id="textname" class="brand-title"><a href="index"style="color: black;"><strong> HOME </strong></a></div>
     <!-- Logo -->
     <a class="navbar-brand center" href="index">
      <img class= "navimg" src="Logo.png" alt="Logo">
      </a>
    <div class="navbar-links">
      <ul>

        <!-- Profile Button -->
        <li><button href="#" type="submit" name="profileBtn" onclick="location.href='Professionalprofilepage'" class="btn btn-outline-info justify-content-center" style="border-radius: 45px;"> PROFILE </button></li>
        
        <!-- Logout Button -->
        <li><form action="logout.inc" method="post"> <button type="submit" name="logoutBtn" style="border-radius: 45px; margin-left: 5px;" class="btn btn-outline-secondary"> Logout </button></form></li>  
      </ul>
    </div>
  </nav>


<?php

  // Loads the file that connetcs the database
  require 'conn.php';

  // Saving the username 
  $applicantname = $_SESSION['username'];
  // Saving the jid from the URL
  $jobid=$_GET['jid'];

  //SQL Query that finds the record of the Job with the ID in the URL
  $query = "SELECT * FROM jobposting WHERE ID='$jobid'";
  $result = mysqli_query($conn, $query);

  // Checks the number of results 
  if(mysqli_num_rows($result) > 0){
    // Runs if the number of results is 1 or more
    while($row = mysqli_fetch_array($result)){
      // Stores the Jobname from the table
      $Jobname = $row['Jobname'];
    }

    // SQL Query that Inserts the Jobname and Logged-in user to the Applicant table
    $sql = "INSERT INTO applicants (Jobname, Applicantname) VALUES ('$Jobname','$applicantname')";
    mysqli_query($conn, $sql);

    // Goes back to the homepage if successful
    // header("location: index");
    echo "<br>
          <br>
          <center><h5>You have successfully Applied for the Job </h5>
          <br>
          <br>
          <a href='index'><button class='btn btn-outline-info justify-content-center'> Home </button> </a>
          </center>";
    // header('Location: '.$_SERVER['REQUEST_URI']);
    exit();

  } else {
    echo "Database error";
    exit();
  }

  // Closes the database connection
  $conn->close();

?>

</body>
</html>




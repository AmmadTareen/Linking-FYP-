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
    <h1 class="profileTitles"><a href="meetings"style="color: black;"> Meetings </a></h1>
<br>


<br>
<br>

<center>
<!-- Printing all the jobs that have been approved -->
<button type="button" id="openBtn" class="btn btn-outline-info justify-content-center openBtn"> On-going Jobs </button>

<!-- Printing all the jobs that applicants have not been selected for-->
<button type="button" id="appBtn" class="btn btn-outline-info justify-content-center openBtn"> Applicants </button>

<!-- Printing all the jobs -->
<button type="button" id="closedBtn" class="btn btn-outline-info justify-content-center openBtn"> All Jobs </button>
</center>

<br>
<div id="line" class="yesPrint"><center><small> Click any of the buttons to show the joblist</small></center></div>


<!-- On- Going jobs / Jobs that have an applicant assigned -->
<div id='openjobs' class='noPrint'>
<?php
  
  // Loading the Database Connection File
  require 'conn.php';

  // Saves the username of the user who is logged in
  $username = $_SESSION['username'];

  // SQL Query that fetches Jobs that have an Applicant selected
  $sql = "SELECT * FROM jobposting WHERE Username='$username' AND appstatus = 1";
  $result = mysqli_query($conn,$sql);

  // Checks the number of results
  if (mysqli_num_rows($result) > 0) {
    // Runs if the number of results is 1 or more
    while($row = mysqli_fetch_array($result)){
      // Prints the Job data
      echo " <span> <div class='featuredBox4' style='border-color:red;'>
            <br> <h5 style='margin-top: -10%;'>Job: ". $row["Jobname"] . "</h5>
            <br> <h6>Description: ". $row['Jobdesc'] . "<h6>
            <h6>Field: ". $row['Jobfield'] . "<h6>
            <br> <h6>Applicant: <a style='color: black;' href='professionalprofile?username=".$row['applicant']."'>". $row['applicant'] . "</a><h6>
            <br>
            <center><td> <a style='border-radius: 45px; margin-top: 1%;' href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> Zoom Meeting </button></a> </td> </center>
            </span> </div>";
    }
  } else {
    echo "<center> <h6>No on-going jobs</h6> </center>";
  }

?>
</div>

<!-- Applicants / Jobs that have applicants but no one has been selected -->
<div id='appdiv' class='noPrint'>
<?php
  
  // Loading the Database Connection File
  require 'conn.php';

  // Saves the username of the user who is logged in
  $username = $_SESSION['username'];

  // SQL Query that fetches Jobs where an Applicant has not been selected
  $sql = "SELECT * FROM jobposting WHERE Username='$username' AND appstatus = 0";
  $result = mysqli_query($conn,$sql);
  $result1 = mysqli_num_rows($result);

  // Checks the number of results
  if (mysqli_num_rows($result) > 0) {
    // Runs if the number of results is 1 or more
    while($row = mysqli_fetch_array($result)){
      // Saves the Jobname in a variable
      $jobname = $row['Jobname'];

      // SQL Query that fetches for the Applicants of the Job in $jobname
      $sqlapp = "SELECT * FROM applicants WHERE Jobname='$jobname'";
      $results = mysqli_query($conn,$sqlapp);
      $result2 = mysqli_num_rows($results);

            // Runs if the number of results is 1 or more
            if(mysqli_num_rows($results) > 0){
              // Prints the Applicant data
              echo "<span> <div class='featuredBox4' style='border-color:red;'>
                <center> <br>
                <br> <h5 style='margin-top: -10%;'>Job: ". $row["Jobname"] . "</h5>
                <br> <h6>Description: ". $row['Jobdesc'] . "<h6>
                <br> <h6>Field: ". $row['Jobfield'] . "<h6>
                  <td> <a style='border-radius: 25px; margin-left: 5px; margin-top: 3%;' href='applicant?jid=".$row['ID']."<button type='button' class='btn btn-outline-info justify-content-center'> Applicants </button></a> </td>";          
              echo "</center> </div> </span>";
              }
            }
  } else {
    echo "<center> <h6>No jobs with applicants</h6> </center>";
  }

  if ($result1 >0 && $result2 == 0 ) {
    echo "<center> <h6>No jobs with applicants</h6> </center>"; 
  }


?>
</div>


<!-- All jobs / All jobs posted by the user -->
<div id='alldivs' class='noPrint'>
<?php
  
  // Loading the Database Connection File
  require 'conn.php';

  // Saves the username of the user who is logged in
  $username = $_SESSION['username'];

  // SQL Query that fetches all the Jobs posted by the Logged-in user
  $sql = "SELECT * FROM jobposting WHERE Username='$username'";
  $result = mysqli_query($conn,$sql);

  // Checks the number of results 
  if (mysqli_num_rows($result) > 0) {
    // Runs if the number of results is 1 or more
    while($row = mysqli_fetch_array($result)){
      // Prints the Jobposting data
      echo "<span> <div class='jobBoxes' style='border-color:red;'>
              <h5 class='joblist' style='margin-top: 0%;'>Job: ". $row["Jobname"] . "</h5>
              <h6 class='joblist'>Description: ". $row['Jobdesc'] . "</h6>
              <h6 class='joblist'>Field: ". $row['Jobfield'] . "</h6>
            </div> </span>";
    }
    // If the number of results is 0
  } else {
    echo "<center> <h6>You have not posted any jobs </h6> </center>";
  }

?>
</div>

<script type="text/javascript">

  // On-going button
  document.getElementById("openBtn").onclick = function() {ongoing()};

  // Applicants button
  document.getElementById("appBtn").onclick = function() {appjobs()};

  // All Jobs button
  document.getElementById("closedBtn").onclick = function() {alljobs()};


  // On-going function
  function ongoing() {

    document.getElementById('openjobs').className = 'yesPrint';
    document.getElementById('appdiv').className = 'noPrint';
    document.getElementById('alldivs').className = 'noPrint';
    document.getElementById('line').className = 'noPrint';
  }

  // Applicants function
  function appjobs() {

    document.getElementById('openjobs').className = 'noPrint';
    document.getElementById('appdiv').className = 'yesPrint';
    document.getElementById('alldivs').className = 'noPrint';
    document.getElementById('line').className = 'noPrint';
  }

  // All Jobs function
  function alljobs() {

    document.getElementById('openjobs').className = 'noPrint';
    document.getElementById('appdiv').className = 'noPrint';
    document.getElementById('alldivs').className = 'yesPrint';
    document.getElementById('line').className = 'noPrint';
  }

</script>

</body>
</html>





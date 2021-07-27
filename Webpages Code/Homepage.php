<!DOCTYPE html>
<html lang="en">
<head>
  <title>Linking Site</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="Linking.css">
  <link rel="stylesheet" type="text/css" media="screen and (min-width: 320px) and (max-width: 500px) and (max-width: 786px) " href="LinkingMob.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>

<!-- Nav Bar -->
  <nav class="navbar">
    <!-- Text on the left hand side -->
    <div id="textname" class="brand-title"><a href="Homepage"><strong> HOME </strong></a></div>
    <!-- Logo -->
     <a class="navbar-brand center" href="Homepage">
      <img class= "navimg" src="Logo.png" alt="Logo">
      </a>
    <div class="navbar-links">
      <ul>
        <!-- Login Button -->
        <li><button type="button" onclick="location.href='Login'" style="border-radius: 45px;" class="btn btn-outline-secondary">Log-In</button></li>

        <!-- Sign-up Button -->
        <li> <button type="button" onclick="location.href='Signup'" style="border-radius: 45px; margin-left: 5px;"class="btn btn-outline-secondary">Sign-Up</button></li>
      </ul>
    </div>
  </nav>

  <br>


<!-- Featured Professional Section -->
<h1 class="pt-2 text-center">Hire <span class="text-info" id="word"> Professionals </span> by the Hour</h1>
<hr class="topline">
<h4 style="margin-left: 50px;"> Featured <span class="text-info" id="word2"> Professionals </span>:</h4>
<br>

<div class="wrapper">


<!-- Featured Professional Boxes, Displays 3 boxes on the homepage-->


<!-- Prints 3 Professionals in the IT Field-->
<div id="IT" class="noPrint">
<?php
  require 'conn.php';
  $sql = "SELECT * FROM users WHERE Field='IT' LIMIT 3";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
          echo "<div class='featuredBox1'> 
          <center>
          <img src='uploads/profile".$row['ID'].".jpg' class='iconImg'>
          <br>
          <br>
          <br>
          <h3>".$row['Username']."</h3>
          <p><a href='mailto:'".$row['Email'].">".$row['Email']."</a></p>
          </center> </div>";
    }
  } else {
    echo "Waiting for more Professionals";
  }

?>

</div>


<!-- Prints 3 Professionals in the Lawyers Field-->
<div id="Law" class="noPrint">
<?php
  require 'conn.php';
  $sql = "SELECT * FROM users WHERE Field='Law' LIMIT 3";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
          echo "<div class='featuredBox1'> 
          <center>
          <img src='uploads/profile".$row['ID'].".jpg' class='iconImg'>
          <br>
          <br>
          <br>
          <h3>".$row['Username']."</h3>
          <p><a href='mailto:'".$row['Email'].">".$row['Email']."</a></p>
          </center> </div>";
    }
  } else {
    echo "Waiting for more Professionals";
  }

?>

</div>



<!-- Prints 3 Professionals in the Medical Field-->
<div id="Doctors" class="noPrint">
<?php
  require 'conn.php';
  $sql = "SELECT * FROM users WHERE Field='Medicine' LIMIT 3";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
          echo "<div class='featuredBox1'> 
          <center>
          <img src='uploads/profile".$row['ID'].".jpg' class='iconImg'>
          <br>
          <br>
          <br>
          <h3>".$row['Username']."</h3>
          <p><a href='mailto:'".$row['Email'].">".$row['Email']."</a></p>
          </center> </div>";
    }
  } else {
    echo "Waiting for more Professionals";
  }

?>

</div>

<!-- Prints 3 Professionals in the Personal Training Field-->
<div id="PersonalTraining" class="noPrint">
<?php
  require 'conn.php';
  $sql = "SELECT * FROM users WHERE Field='Personal Training' LIMIT 3";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
          echo "<div class='featuredBox1'> 
          <center>
          <img src='uploads/profile".$row['ID'].".jpg' class='iconImg'>
          <br>
          <br>
          <br>
          <h3>".$row['Username']."</h3>
          <p><a href='mailto:'".$row['Email'].">".$row['Email']."</a></p>
          </center> </div>";
    }
  } else {
    echo "Waiting for more Professionals";
  }

?>

</div>

<!-- Second Sign-up Button area -->
<hr class="topline">
<br>
<div class="second-section">
<h5>The platform that allows professionals from any and every career to sell their time online.</h5>


<button type="button" onclick="location.href='Signup'" class="btn btn-outline-secondary justify-content-center">Sign-Up</button>
<br>
<h5>Do you need some advise or need to hire an expert in their respective field?</h5>
</div>
<br>


<hr class="topline">
<h4 class="listTitle justify-content-center text-center"style="margin-top: 50px;">Are you a Professional or do you require Professional Services</h4>
<br>

<!-- Professional Description Button -->
<button type="button" id="professionalInfo" class="btn btn-outline-info justify-content-center profHomeBtn"> Professional </button>

<!-- Customer Description Button -->
<button type="button" id="customerInfo" class="btn btn-outline-info justify-content-center customerHomeBtn"> Customer </button>

<br>
<br>
<hr>

<!-- Content when the Professional Button is clicked -->
<div class="displaying-boxes">
<div id="professionalDiv" class="noPrint">


  <br>
  <img src="Professional.png" class="iconImg center">
  <br>
  <h5 class="text-center">As a Professional</h5>

  <div class="infoBox1">
  <img src="Magnifying.png" class="iconImg proicons">
  <h4 class="justify-content-center text-center" style="margin-top: 5px;">Find what suits you</h4>
  <h5 style="margin-top: 25px;">Find a Job or query that suits your expertise and approach the client with your estimated cost</h5>
  </div>

  <div class="infoBox1">
  <img src="Calender.png" class="iconImg proicons">
  <h4 class="justify-content-center text-center" style="margin-top: 20px;">Connect and agree on the terms</h4>
  <h5 style="margin-top: 30px;">Meet the client via the Zoom link generated and come to an agreement for the work to be done</h5>
  </div>

  <div class="infoBox1">
    <img src="Briefcase.png" class="iconImg proicons">
    <h4 class="justify-content-center text-center" style="margin-top: 20px;">Start Working</h4>
  <h5 style="margin-top: 10px;">Note down your progress in the weekly progress reports and attend the weekly Zoom meetings so both you and your client are on the same page</h5>
  </div>

  <button type="button"  onclick="location.href='Professionalsignupform'"class="btn btn-outline-info justify-content-center">Professional Sign-up</button>
  <hr class="topline">

</div>
</div>


<!-- Content when the Customer Button is clicked -->
<div class="displaying-boxes">
<div id="customerDiv" class="noPrint">

  <br>
  <img src="Professional.png" class="iconImg center">
  <br>
  <h5 class="text-center">As a Customer</h5>

  <div class="infoBox1">
  <img src="Magnifying.png" class="iconImg proicons">
  <h4 class="justify-content-center text-center" style="margin-top: 10px;">Find your Professional</h4>
  <h5 style="margin-top: 30px;"> You could either post a job or search for the professional you require</h5>
  </div>

  <div class="infoBox1">
  <img src="Calender.png" class="iconImg proicons">
  <h4 class="justify-content-center text-center" style="margin-top: 20px;">Connect and agree on the terms</h4>
  <h5 style="margin-top: 30px;">Meet the professional via the Zoom link generated and come to an agreement for the work to be done</h5>
  </div>

  <div class="infoBox1">
  <img src="Briefcase.png" class="iconImg proicons">
  <h4 class="justify-content-center text-center" style="margin-top: 20px;">Monitor the work</h4>
  <h5 style="margin-top: 10px;"> Monitor the work done by talking to the professional at a regular Zoom meeting</h5>
  </div>

  <button type="button"  onclick="location.href='Customersignupform'"class="btn btn-outline-info justify-content-center">Customer Sign-up</button>
  <hr class="topline">


</div>
</div>




<script type="text/javascript">
  // First Professional word switcher
  $(function () { 
    // Header section Count
    count = 0; 
    // Featured section Count
    fCount = 0;

    // Variable that stores the printed word from the featuredWordsArray
    var word;

    // Array for the words that display in the Header
    wordsArray = ["Professionals", "Tutors", "Software Developers", "Lawyers", "Doctors", "Personal Trainers"]; 

    // Array for the words that display in the featured Section
    featuredWordsArray = [ "Lawyers", "IT Consultants", "Doctors", "Personal Trainers"]; 

    // Function for the Headers word
    setInterval(function () { 
      count++; 
      // The word is switched here, fading in the old and fading in the new
      $("#word").fadeOut(500, function () { 
        // Assigning the new word here
        $(this).text(wordsArray[count % wordsArray.length]).fadeIn(500); 
      }); 
      // Function is run every 2 seconds
    }, 2000);

    // Function for the Feature Section word
    setInterval(function () { 
      fCount++; 
      // The word is switched here, fading in the old and fading in the new
      $("#word2").fadeOut(500, function () { 
        // Assigning the new word here
        $(this).text(featuredWordsArray[fCount % featuredWordsArray.length]).fadeIn(500); 

        // Assigning the current word being printed from the featuredWordsArray
        word = featuredWordsArray[fCount % featuredWordsArray.length];

        // Runs if the word is "IT Consultants"
        if (word == featuredWordsArray[1]) {
          // Prints the div with the id = "IT"
          document.getElementById("IT").className = 'yesPrint';
          // Does not print the div with the id = "Doctors"
          document.getElementById("Doctors").className = 'noPrint';
          // Does not print the div with the id = "PersonalTraining"
          document.getElementById("PersonalTraining").className = 'noPrint';
          // Does not print the div with the id = "Law"
          document.getElementById("Law").className = 'noPrint';

          // Runs if the word is "Doctors"
        } else if (word == featuredWordsArray[2]){
          // Does not print the div with the id = "IT"
          document.getElementById("IT").className = 'noPrint';
          // Prints the div with the id = "Doctors"
          document.getElementById("Doctors").className = 'yesPrint';
          // Does not print the div with the id = "PersonalTraining"
          document.getElementById("PersonalTraining").className = 'noPrint';
          // Does not print the div with the id = "Law"
          document.getElementById("Law").className = 'noPrint';

          // Runs if the word is "Personal Trainers"
        } else if (word == featuredWordsArray[3]) {
          // Does not print the div with the id = "IT"
          document.getElementById("IT").className = 'noPrint';
          // Does not print the div with the id = "Doctors"
          document.getElementById("Doctors").className = 'noPrint';
          // Prints the div with the id = "PersonalTraining"
          document.getElementById("PersonalTraining").className = 'yesPrint';
          // Does not print the div with the id = "Law"
          document.getElementById("Law").className = 'noPrint';

          // Runs if the word is "Lawyers"
        } else if (word == featuredWordsArray[0]) {
          // Does not print the div with the id = "IT"
          document.getElementById("IT").className = 'noPrint';
          // Does not print the div with the id = "Doctors"
          document.getElementById("Doctors").className = 'noPrint';
          // Does not print the div with the id = "PersonalTraining"
          document.getElementById("PersonalTraining").className = 'noPrint';
          // Prints the div with the id = "Law"
          document.getElementById("Law").className = 'YesPrint';
        }

      }); 
      // Function is run every 6 seconds
    }, 6000);

  });

  // Function when the Professional Button is clicked
  document.getElementById("professionalInfo").onclick = function() {myFunction()};

  function myFunction() {

    // Changes the class name of the professionalBoxes section so they are printed on the page
    document.getElementById('professionalDiv').className = 'yesPrint';
    document.getElementById('customerDiv').className = 'noPrint';

    // Scrolls to the section that has just been printed / Scrolls a little down to where the boxes start
    var elmnt = document.getElementById("professionalDiv");
    elmnt.scrollIntoView();
  }

  document.getElementById("customerInfo").onclick = function() {myFunction2()};

  function myFunction2() {
    // Changes the class name of the customerBoxes section so they are printed on the page
    document.getElementById('professionalDiv').className = 'noPrint';
    document.getElementById('customerDiv').className = 'yesPrint';
    // Scrolls to the section that has just been printed / Scrolls a little down to where the boxes start
    var elmnt = document.getElementById("customerDiv");
    elmnt.scrollIntoView();
  }

</script>

</body>
</html>
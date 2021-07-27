<?php
	session_start()
?>

<!-- Initial Login Page -->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Log in</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="Linking.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body style="background-color: black;">

<!-- Nav Bar -->
  <nav class="navbar">
    <!-- Text on the left side -->
    <div id="textname" class="brand-title"><a href="Login"style="color: black;"><strong> LOG-IN </strong></a></div>
    <!-- Logo -->
     <a class="navbar-brand center" href="Homepage">
      <img class= "navimg" src="Logo.png" alt="Logo">
      </a>
    <div class="navbar-links">
      <ul>
        <!-- Login Button -->
        <li><button type="button" onclick="location.href='Login'" style="border-radius: 45px; background-color: black; color: white;" class="btn btn-outline-secondary">Log-In</button></li>

        <!-- Sign-up Button -->
        <li> <button type="button" onclick="location.href='Signup'" style="border-radius: 45px; margin-left: 5px;"class="btn btn-outline-secondary">Sign-Up</button></li>
      </ul>
    </div>
  </nav>

  <br>

<!-- Splitting the page in half -->
<div class="vl"></div>
  
  <!-- Login Buttons -->
  <button id="profbtn"type="button" onclick="location.href='Professionalloginform'" class="btn btn-outline-info justify-content-center professionalLoginBtn"> Professional Log in</button>

  <button id="customerloginBtn" type="button" onclick="location.href='Customerloginform'" class="btn btn-outline-info justify-content-center customerLoginBtn1"> Customer Log in </button>


</body>
</html>
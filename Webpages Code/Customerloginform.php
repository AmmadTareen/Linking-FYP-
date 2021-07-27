<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Customer Log in</title>

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
<body style="background-color: black;">

  <!-- Nav Bar -->
  <nav class="navbar">
    <!-- Text on the Left Side -->
    <div id="textname" class="brand-title"><a href="Login"style="color: black;"><strong> LOG-IN </strong></a></div>
     <!-- Logo-->
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

<div id="customerLog">

  <!-- Blurring out the Right side -->
  <div class="blur2"></div>  

  <div id="customerLogForm">

    <!-- Customer Login Form -->
    <form class="customerlog-in-form" action="c.login.inc" method="post">
      <label for="username"><b>Username:</b></label>
      <br>
      <input type="text" name="username" placeholder="Username...." required>
      <br>
      <br>
      <label for="password"><b>Password:</b></label>
      <br>
      <input type="password" name="password" placeholder="Passord...." required>
      <br>
      <br>

      <?php

        //Error Handling
        if(isset($_GET['error'])) {
          if($_GET['error'] == "incorrectpassword") {
            echo '<p style="color:red;font-size: 20px; margin-left: 1.5%;"> Incorrect Password </p>'; 
          } elseif ($_GET['error'] == "invalidcredentials") {
            echo '<p style="color:red;font-size: 20px; margin-left: 1.5%;"> Invalid Username or Password </p>'; 
          }
        }
      ?> 
      <!-- Login button -->
      <button class="btn btn-outline-info justify-content-center customerLoginSubmitBtn" type="submit" name="customerLoginSubmit"> Log-in </button>

      <br>
      <button class="btn btn-outline-info justify-content-center profSubmitBtn1" style="margin-left: 3%;" onclick="location.href='Professionalloginform'" type="submit" name="profSubmit"> <- Professional Log-in </button>
    </form>

    <!-- Professional Login Button on the Blurry side -->
    <button id="profbtn"type="button" style="margin-top: -20%" class="btn btn-outline-info justify-content-center professionalLoginBtn"> Professional Log in</button>
</div>

</div>

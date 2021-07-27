<!-- Customer Sign up Form Page -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Customer Signed up</title>

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
    <!-- Text on the Left side-->
    <div id="textname" class="brand-title"><a href="Signup"style="color: black;"><strong> SIGN-UP </strong></a></div>
    <!-- Logo -->
     <a class="navbar-brand center" href="Homepage">
      <img class= "navimg" src="Logo.png" alt="Logo">
      </a>
    <div class="navbar-links">
      <ul>
        <!-- Login Button -->
        <li><button type="button" onclick="location.href='Login'" style="border-radius: 45px;" class="btn btn-outline-secondary">Log-In</button></li>

        <!-- Sign-up Button -->
        <li> <button type="button" onclick="location.href='Signup'" style="border-radius: 45px; margin-left: 5px; background-color: black; color: white;"class="btn btn-outline-secondary">Sign-Up</button></li>
      </ul>
    </div>
  </nav>

  <br>


<!-- Splitting the page in half -->
<div class="vl"></div>

<!-- Blurring out the Left side -->
<div class="blur2"></div>
<!--Button hidden under the blur -->
<button id="profbtn"type="button" class="btn btn-outline-info justify-content-center professionalLoginBtn"> Professional Sign in</button>

<div id="customerForm">

    <!-- Customer Sign-up Form -->
    <form id="csign" class="customersign-up-form" style="margin-top: -20%;" action="c.signup.inc" method="post">
      <label for="username"><b>Username:</b></label>
      <br>
      <small><b>(Alphabets and Numbers only)</b></small>
      <br>
      <input type="text" name="username" placeholder="Username...." required>
      <br>
      <br>
      <label for="email"><b>Email:</b></label>
      <br>
      <input type="email" name="email" placeholder="Email Address...." required>
      <br>
      <br>
      <label for="password"><b>Password:</b></label>
      <br>
      <input type="password" name="password" placeholder="Passord...." required>
      <br>
      <br>
      <label for="password2"><b>Re-enter Password:</b></label>
      <br>
      <input type="password" name="password2" placeholder="Re-enter Password...." required>
      <br>
      <br>
      <?php
        // Error Handling
        if(isset($_GET['error'])) {
          if($_GET['error'] == "usernametaken") {
            echo '<p style="color:red;font-size: 20px; margin-left: 1.5%;"> Username already Taken </p>'; 
          } elseif ($_GET['error'] == "invalidusername") {
            echo '<p style="color:red;font-size: 20px; margin-left: -6%;"> Username does not match the criteria </p>';
          } elseif ($_GET['error'] == "invalidemail") {
            echo '<p style="color:red;font-size: 20px; margin-left: 1.5%;"> Entered an invalid email address </p>';
          } elseif ($_GET['error'] == "passwordcheck") {
            echo '<p style="color:red;font-size: 20px; margin-left: 1.5%;"> Passwords do not match </p>'; 
          } elseif ($_GET['error'] == "emailtaken") {
            echo '<p style="color:red;font-size: 20px; margin-left: 1.5%;"> Email already Taken </p>'; 
          } elseif ($_GET['error'] == "sqlerror") {
            echo '<p style="color:red;font-size: 20px; margin-left: -2%;"> There was an issue with the Database </p>'; 
          }
        }
      ?>
      <!-- Sign-up Button -->
      <button class="btn btn-outline-info justify-content-center customerSubmitBtn" type="submit" name="customerSubmit"> Sign-up</button>

       <br>
      <button class="btn btn-outline-info justify-content-center profSubmitBtn1" onclick="location.href='Professionalsignupform'" type="submit" name="profSubmit"> <- Professional Sign-up </button>
    </form>

</div>
<!-- Professional Signed up Page -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Professional Signed up</title>

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
    <!-- Text on the Left hand side -->
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

<!-- Blurrs out the Right side -->
<div class="blur"></div>
  <!-- Prints when the user has successfully signed up -->
  <h1 class="profSignedHeading">You have successfully signed up! </h1>

  <button id="profbtn"type="button" onclick="location.href='Login'" style="margin-top: 4%; margin-left: 18%;" class="btn btn-outline-info justify-content-center professionalLoginBtn"> Log in</button>




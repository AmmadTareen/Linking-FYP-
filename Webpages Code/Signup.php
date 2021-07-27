<!-- Initial Sign-up page  -->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sign up</title>

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
    <!-- Text on the left hand side -->
    <div id="textname" class="brand-title"><a href="Signup"style="color: black;"><strong> SIGN-UP </strong></a></div>
    <!-- Logo -->
     <a class="navbar-brand center" href="Homepage">
      <img class= "navimg" src="Logo.png" alt="Logo">
      </a>
    <div class="navbar-links">
      <ul>
        <!-- Login button -->
        <li><button type="button" onclick="location.href='Login'" style="border-radius: 45px;" class="btn btn-outline-secondary">Log-In</button></li>

        <!-- Sign-up Button -->
        <li> <button type="button" onclick="location.href='Signup'" style="border-radius: 45px; margin-left: 5px; background-color: black; color: white;"class="btn btn-outline-secondary">Sign-Up</button></li>
      </ul>
    </div>
  </nav>

  <br>

<!-- Splitting the page in half -->
<div class="vl"></div>

<!-- Professional Button -->
<button id="profbtn"type="button" class="btn btn-outline-info justify-content-center professionalSign"> Professional </button>

<!-- Customer Button -->
<button id="customerbtn" type="button" class="btn btn-outline-info justify-content-center customerSign"> Customer </button>


<!-- Displayed when the Professional Button is clicked -->
<div id="professionalSign" class="noPrint">
  <!-- Blur the Customer Side -->
  <div class="blur"></div>  

  <h6 class="professionalDes">I have enough experience to be of use to others.</h6>
  <br>
  <h6 class="professionalDes2">I can not only provide one off advice sessions but can work on a project if need be</h6>

  <button id="profSignUpBtn"type="button" onclick="location.href='Professionalsignupform'" class="btn btn-outline-info justify-content-center proSignup" > Professional Sign up </button>

</div>


<!-- Displayed when the Customer Button is clicked -->
<div id="customerSign" class="noPrint">
  <!-- Blur the Professional Side -->
  <div class="blur2"></div>  

  <h6 class="customerDes">I want to be connected to professionals for their advice or help on a project.</h6>
  <br>
  <button id="customerbtn1" type="button" onclick="location.href='Customersignupform'" class="btn btn-outline-info justify-content-center customerSign1"> Customer Sign up </button>

</div>


<script type="text/javascript">

// Function when the Professional Button is clicked
  document.getElementById("profbtn").onclick = function() {profSignUp()};

  function profSignUp() {
    // Changes the class name of the professionalBoxes section so they are printed on the page
    document.getElementById('professionalSign').className = 'yesPrint';
    document.getElementById('profbtn').style.display = 'none';
    document.getElementById('customerSign').className = 'noPrint';
    document.getElementById('customerbtn').style.marginTop = '20%';
  }

  // Function when the Customer Button is clicked
  document.getElementById("customerbtn").onclick = function() {customerSignIn()};

  function customerSignIn() {
    // Changes the class name of the professionalBoxes section so they are printed on the page
    document.getElementById('professionalSign').className = 'noPrint';
    document.getElementById('profbtn').style.marginTop = '20%';
    document.getElementById('customerbtn').style.display = 'none';
    document.getElementById('customerSign').className = 'yesPrint';
  }

</script>

</body>
</html>
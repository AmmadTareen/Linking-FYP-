<?php

// Logout Logic

session_start();
session_unset();
// Destroys the session
session_destroy();
// Send the user to the Login Page
header("location: Login.php");
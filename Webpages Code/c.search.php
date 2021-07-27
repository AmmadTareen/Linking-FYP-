<?php  
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search Page</title>

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
        <li><button type="submit" name="profileBtn" onclick="location.href='Customerprofilepage'" style="font-size: 15px; border-radius: 45px;" class="btn btn-outline-info justify-content-center profilenavBtn"> PROFILE </button></li>

        <!-- Logout Button -->
        <li><form action="logout.inc" method="post"> <button type="submit" name="logoutBtn" style="font-size: 15px;border-radius: 45px; margin-left: 5px;" class="btn btn-outline-secondary logoutnavBtn"> Logout </button></form></li>  
      </ul>
    </div>
  </nav>


<br>

  

<?php
  // Loads the Database connection file
  require 'conn.php';

  // Runs if the Search button was clicked or enter was pressed
  if (isset($_POST['submit_search'])) {
    // Prevents SQL Injection / Security purposes
    $search = mysqli_real_escape_string($conn, $_POST['wordsearched']);

    // SQL Query 
    $sqlsearch = "SELECT * FROM users WHERE Field LIKE '%$search%' OR Username LIKE '%$search%'";

    // Creates the result variable
    $result = mysqli_query($conn,$sqlsearch);

    // Stores the number of results recieved
    $numResult = mysqli_num_rows($result);

    // Printing the number of search results
    if ($numResult <= 0 ){
      echo "There are ".$numResult." Results";
    } elseif ($numResult <= 1) {
      echo "There is ".$numResult." Result";
    } else {
      echo "There are ".$numResult." Results";
    }

    echo "<p>";

    // Checks number of rows in the Result Variable, should always be greater than 0 if the query is correct
    if ($numResult > 0 ) {
      while($row = mysqli_fetch_array($result)){
        echo '<div class="userbox"';
        $ID = $row['ID'];
        echo "<div class='article-container'> 
          <center>";
            
        // SQL Query to find out whether the user has a Profile Picture or not
          $sqlimg = "SELECT * FROM profileImg WHERE userID = '$ID'";
          $resultimg = mysqli_query($conn, $sqlimg);
          // Printing the results from the profileImg database
          while($rowimg = mysqli_fetch_array($resultimg)){
            // Prints if the user does not have a Profile Picture
            if($rowimg['status'] ==1 ){
              echo "<img src='uploads/profile.jpg' class='iconImg'>";
              // Prints if the user does have a Profile Picture
            } else {
              echo "<img src='uploads/profile".$row['ID'].".jpg' class='iconImg'>";
            }
          }

        echo "<br>
          <br>
          <center><td> <a style='color:black; margin-top: 1%;' href='professionalprofile?username=".$row['Username']."' target='_blank'> ".$row['Username']." </button></a> </td> </center>
          <p><a href='mailto:'".$row['Email'].">".$row['Email']."</a></p>
          <p>Field: ".$row['Field']."</p>
          </center>
          <br>
        </div> </div>";
      }
    } else {
        // When no results are found / Search Query is does not exist
        echo "There are no results matching your query";
    }
  }
?>



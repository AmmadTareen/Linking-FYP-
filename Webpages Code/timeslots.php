<?php
  session_start();
  $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Booking Page</title>

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
  	<!-- Text on the Left side -->
    <div id="textname" class="brand-title"><a href="index"style="color: black;"><strong> HOME </strong></a></div>
     <!-- Logo -->
     <a class="navbar-brand center" href="index">
      <img class= "navimg" src="Logo.png" alt="Logo">
      </a>
    <div class="navbar-links">
      <ul>

      	<!-- Profile Button -->
        <li><button href="#" type="submit" name="profileBtn" onclick="location.href='Professionalprofilepage'" class="btn btn-outline-info justify-content-center" style="border-radius: 45px; background-color: #5bc0de; color: white;"> PROFILE </button></li>

        <!-- Logout Button -->
        <li><form action="logout.inc" method="post"> <button type="submit" name="logoutBtn" style="border-radius: 45px; margin-left: 5px; color: black;" class="btn btn-outline-secondary"> Logout </button></form></li>  
      </ul>
    </div>
  </nav>

  <br>

  <!-- Add a meeting Box -->
  <center>
  <div class="timebox" style="color: black;">
  	<form action='addtime' method='post'>
  		<br>
  	<center>
  	<label for="Day" style="margin-left: 4%;">Day:</label>
  	<input style="margin-left: 4%" class="joblist" type="text" name="day" placeholder="Enter Day">
  	<br>
  	<small>Days from Monday - Friday</small>
  	<br>
  	<label class="joblist"> Time: </label>
  	<input class="joblist" style="margin-top: 2%;" type="time" pattern="[0-9]{2}:[0-9]{2}" name="time" placeholder="HH:MM" required>

  	<br>
  	<small> Time should be written in a 24hr format </small>
  	<br>
  	<?php
  		if(isset($_GET['error'])) {
          if($_GET['error'] == "duplicate") {
            echo"<center><small style='color: red;'> Meeting Already Exists</small></center>"; 
          } else if ($_GET['error'] == "sqlerror") {
          	echo"<center><small style='color: red;'> Databse Issue ><small></center>"; 
          } else if ($_GET['error'] == "incorrecttime") {
          	echo "<center><small style='color: red;'> The time entered is incorrect </small></center>";
          } else if ($_GET['error'] == "wrongday") {
          	echo "<center><small style='color: red;'> The day entered is incorrect </small></center>";
          } 
      }

       if (isset($_GET['success'])) {
          	if ($_GET['success'] == "timeadded") {
          		echo "<center><small style='color: green;'> Meeting has been added </small></center>";
          	}
          }

    ?>

  	<button id="add" formmethod="post" class="btn btn-outline-info justify-content-center" style="margin-top: -0.5%;">Add</button>
  	</center>
  </form>
  </div>
  </center>


	<br>

	<!-- Monday Boxes -->
	<div class="jobinfo">
	<?php
		
		// Loads the file that connects to the database
		require 'conn.php';

		// SQL Query searching for the username from the session AND the day specified, Printing in chronological order of time
		$sql = "SELECT * FROM professionalbooking WHERE Username = '$username' AND Day='monday' ORDER BY Meetingtime";
		$result = mysqli_query($conn, $sql);

		// Prints the header with the day 
		echo "<center><h4 style='color: black;'><u> Monday </u></h4></center>";

		// Checks the number of results 
		if(mysqli_num_rows($result)>0){

			// Runs if the number of results is 1 or more
			while($row = mysqli_fetch_array($result)){
				// Prints data 
				echo "<center>
						<div class='timebox2'style='color: black'>
						<h6 class='joblist' style='margin-top: 1%; margin-left: 0.5%;'> Time: ".$row['Meetingtime']."</h6>
						<br>";
						// Status 0 means that no-one has booked the meeting
						if ($row['Status'] == 0) {
							// Status 1 means someone has booked the meeting and prints the name
							echo "<h6 class='joblist' style='margin-left: 0.5%;'> No Booking Made</h6>
							
								<td> <a href='meetingdelete?bid=".$row['ID']."'> <button id='deleteBtn' class='btn btn btn-outline-info justify-content-center'> Delete </button></a> </td>";

							} else {
								echo "<h6 class='joblist' style='margin-left: 0.5%;'> Customer: ".$row['Cuser']."</h6>
									
									<br>

									<td> <a href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> <button class='btn btn-outline-info justify-content-center'> Meet ".$row['Cuser']." </button></a> </td>

									<td> <a href='meetingdelete?bid=".$row['ID']."'> <button id='deleteBtn' class='btn btn btn-outline-info justify-content-center'> Delete </button></a> </td>
								";
						}

					echo "</div> </center>";
			}
		  // Prints if the professionalbooking table shows no results
		} else {
			echo "<center>
					<p> You have not added any booking times </p>
				  </center>";
		}

	?>
	</div>


	<!-- Tuesday Boxes -->
	<div class="jobinfo">
	<?php
		
		// Loads the file that connects to the database
		require 'conn.php';

		// SQL Query searching for the username from the session AND the day specified, Printing in chronological order of time 
		$sql = "SELECT * FROM professionalbooking WHERE Username = '$username' AND Day='Tuesday' ORDER BY Meetingtime";
		$result = mysqli_query($conn, $sql);

		// Prints the header with the day 
		echo "<center><h4 style='color: black;'><u> Tuesday </u></h4></center>";

		// Checks the number of results 
		if(mysqli_num_rows($result)>0){

			// Runs if the number of results is 1 or more
			while($row = mysqli_fetch_array($result)){
				// Prints data 
				echo "<center>
						<div class='timebox2'style='color: black'>
						<h6 class='joblist' style='margin-top: 1%; margin-left: 0.5%;'> Time: ".$row['Meetingtime']."</h6>
						<br>";
						// Status 0 means that no-one has booked the meeting
						if ($row['Status'] == 0) {
							// Status 1 means someone has booked the meeting and prints the name
							echo "<h6 class='joblist' style='margin-left: 0.5%;'> No Booking Made</h6>
							
								<td> <a href='meetingdelete?bid=".$row['ID']."'> <button id='deleteBtn' class='btn btn btn-outline-info justify-content-center'> Delete </button></a> </td>";

							} else {
								echo "<h6 class='joblist' style='margin-left: 0.5%;'> Customer: ".$row['Cuser']."</h6>
									
									<br>

									<td> <a href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> <button class='btn btn-outline-info justify-content-center'> Meet ".$row['Cuser']." </button></a> </td>

									<td> <a href='meetingdelete?bid=".$row['ID']."'> <button id='deleteBtn' class='btn btn btn-outline-info justify-content-center'> Delete </button></a> </td>
								";
						}

					echo "</div> </center>";
			}
		  // Prints if the professionalbooking table shows no results
		} else {
			echo "<center>
					<p> You have not added any booking times </p>
				  </center>";
		}

	?>
	</div>

	<!-- Wednesday Boxes -->
	<div class="jobinfo">
	<?php
		
		// Loads the file that connects to the database
		require 'conn.php';

		// SQL Query searching for the username from the session AND the day specified, Printing in chronological order of time
		$sql = "SELECT * FROM professionalbooking WHERE Username = '$username' AND Day='Wednesday' ORDER BY Meetingtime";
		$result = mysqli_query($conn, $sql);

		// Prints the header with the day 
		echo "<center><h4 style='color: black;'><u> Wednesday </u></h4></center>";

		// Checks the number of results 
		if(mysqli_num_rows($result)>0){

			// Runs if the number of results is 1 or more
			while($row = mysqli_fetch_array($result)){
				// Prints data 
				echo "<center>
						<div class='timebox2'style='color: black'>
						<h6 class='joblist' style='margin-top: 1%; margin-left: 0.5%;'> Time: ".$row['Meetingtime']."</h6>
						<br>";
						// Status 0 means that no-one has booked the meeting
						if ($row['Status'] == 0) {
							// Status 1 means someone has booked the meeting and prints the name
							echo "<h6 class='joblist' style='margin-left: 0.5%;'> No Booking Made</h6>
							
								<td> <a href='meetingdelete?bid=".$row['ID']."'> <button id='deleteBtn' class='btn btn btn-outline-info justify-content-center'> Delete </button></a> </td>";

							} else {
								echo "<h6 class='joblist' style='margin-left: 0.5%;'> Customer: ".$row['Cuser']."</h6>
									
									<br>

									<td> <a href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> <button class='btn btn-outline-info justify-content-center'> Meet ".$row['Cuser']." </button></a> </td>

									<td> <a href='meetingdelete?bid=".$row['ID']."'> <button id='deleteBtn' class='btn btn btn-outline-info justify-content-center'> Delete </button></a> </td>
								";
						}

					echo "</div> </center>";
			}
		  // Prints if the professionalbooking table shows no results
		} else {
			echo "<center>
					<p> You have not added any booking times </p>
				  </center>";
		}

	?>
	</div>

	<!-- Thursday Boxes -->
	<div class="jobinfo">
	<?php
		
		// Loads the file that connects to the database
		require 'conn.php';

		// SQL Query searching for the username from the session AND the day specified, Printing in chronological order of time
		$sql = "SELECT * FROM professionalbooking WHERE Username = '$username' AND Day='Thursday' ORDER BY Meetingtime";
		$result = mysqli_query($conn, $sql);

		// Prints the header with the day 
		echo "<center><h4 style='color: black;'><u> Thursday </u></h4></center>";

		// Checks the number of results 
		if(mysqli_num_rows($result)>0){

			// Runs if the number of results is 1 or more
			while($row = mysqli_fetch_array($result)){
				// Prints data 
				echo "<center>
						<div class='timebox2'style='color: black'>
						<h6 class='joblist' style='margin-top: 1%; margin-left: 0.5%;'> Time: ".$row['Meetingtime']."</h6>
						<br>";
						// Status 0 means that no-one has booked the meeting
						if ($row['Status'] == 0) {
							// Status 1 means someone has booked the meeting and prints the name
							echo "<h6 class='joblist' style='margin-left: 0.5%;'> No Booking Made</h6>
							
								<td> <a href='meetingdelete?bid=".$row['ID']."'> <button id='deleteBtn' class='btn btn btn-outline-info justify-content-center'> Delete </button></a> </td>";

							} else {
								echo "<h6 class='joblist' style='margin-left: 0.5%;'> Customer: ".$row['Cuser']."</h6>
									
									<br>

									<td> <a href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> <button class='btn btn-outline-info justify-content-center'> Meet ".$row['Cuser']." </button></a> </td>

									<td> <a href='meetingdelete?bid=".$row['ID']."'> <button id='deleteBtn' class='btn btn btn-outline-info justify-content-center'> Delete </button></a> </td>
								";
						}

					echo "</div> </center>";
			}
		  // Prints if the professionalbooking table shows no results
		} else {
			echo "<center>
					<p> You have not added any booking times </p>
				  </center>";
		}

	?>
	</div>

	<!-- Friday Boxes -->
	<div class="jobinfo">
	<?php
		
		// Loads the file that connects to the database
		require 'conn.php';

		// SQL Query searching for the username from the session AND the day specified, Printing in chronological order of time
		$sql = "SELECT * FROM professionalbooking WHERE Username = '$username' AND Day='Friday' ORDER BY Meetingtime";
		$result = mysqli_query($conn, $sql);

		// Prints the header with the day 
		echo "<center><h4 style='color: black;'><u> Friday </u></h4></center>";

		// Checks the number of results 
		if(mysqli_num_rows($result)>0){

			// Runs if the number of results is 1 or more
			while($row = mysqli_fetch_array($result)){
				// Prints data 
				echo "<center>
						<div class='timebox2'style='color: black'>
						<h6 class='joblist' style='margin-top: 1%; margin-left: 0.5%;'> Time: ".$row['Meetingtime']."</h6>
						<br>";
						// Status 0 means that no-one has booked the meeting
						if ($row['Status'] == 0) {
							// Status 1 means someone has booked the meeting and prints the name
							echo "<h6 class='joblist' style='margin-left: 0.5%;'> No Booking Made</h6>
							
								<td> <a href='meetingdelete?bid=".$row['ID']."'> <button id='deleteBtn' class='btn btn btn-outline-info justify-content-center'> Delete </button></a> </td>";

							} else {
								echo "<h6 class='joblist' style='margin-left: 0.5%;'> Customer: ".$row['Cuser']."</h6>
									
									<br>

									<td> <a href='https://us04web.zoom.us/wc/join/3193672454?wpk=wcpk489aa870b9a3885cf5999773e26e9f3a' target='_blank'> <button class='btn btn-outline-info justify-content-center'> Meet ".$row['Cuser']." </button></a> </td>

									<td> <a href='meetingdelete?bid=".$row['ID']."'> <button id='deleteBtn' class='btn btn btn-outline-info justify-content-center'> Delete </button></a> </td>
								";
						}

					echo "</div> </center>";
			}
		  // Prints if the professionalbooking table shows no results
		} else {
			echo "<center>
					<p> You have not added any booking times </p>
				  </center>";
		}

	?>
	</div>

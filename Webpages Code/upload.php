<?php

session_start();
require 'conn.php';

$username = $_SESSION['username'];

$sqlID = "SELECT ID FROM users WHERE Username ='$username'";
$resultID = mysqli_query($conn,$sqlID);
if (mysqli_num_rows($resultID)> 0) {
      while($row = mysqli_fetch_array($resultID)){
      	$id = $row['ID'];
      }
  }

if(isset($_POST['submit'])) {
	// $_FILES is a super global (Predifined variable in PHP)
	$file = $_FILES['file'];
	// Variable for the Image name
	$fileName = $file['name'];
	// Variable for the temporary location of the file
	$fileTmpName = $file['tmp_name'];
	// Variable for the Image size
	$fileSize = $file['size'];
	// Variable for the errors
	$fileError = $file['error'];
	// Variable for the Image type
	$fileType = $file['type'];

	// Seperating the filename from the extnesion
	$fileExt = explode('.', $fileName);

	// Saves the file extension to the variable 
	// strtolower converts the extnesion name to lower case letters
	$fileAccExt = strtolower(end($fileExt));

	// The extensions that are to be accepted
	$extAllowed = array('jpg', 'jpeg', 'png');

	// Loop for when the extension mathes the allowed extensions
	if (in_array($fileAccExt, $extAllowed)) {
		//Checking for errors when uploading the file
		if($fileError === 0 ){
			// Limiting the size of the file that can be uploaded
			if($fileSize < 500000){
				// Creating a unique ID for every file, just in case two users upload a smile with the same file names
				// saves the unique id of the file with the acutal extension
				$newfileName = "profile".$id.".".$fileAccExt;
				$fileDest = 'uploads/'.$newfileName;
				//Function to move the file to the uploaded folder
				move_uploaded_file($fileTmpName, $fileDest);
				$sql = "UPDATE profileImg SET status=0 WHERE userID = '$id';";
				$result = mysqli_query($conn,$sql);
				// Changing the URL when the upload is successful
				header("location: profilesettings?success=uploaded");
				exit();
			} else {
				// The file size is too big
				echo "The file is too big to be uploaded";
			}
		} else{
			// If an error was encountered when uploading
			echo "There was an error while uploading your file, please try again";
		}
	} else {
		// If the image type is not in the criteria
		echo "Incorrect File type selected for upload";
	}
}
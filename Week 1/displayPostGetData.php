<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- displayPostGetData.php - HTML test form
  Student Name
  Written:   Current Date 
  -->
 <title>Feedback to User</title>
 <link rel="stylesheet" type="text/css" href="displayData.css">
</head>
<body>
<div id="frame">

<?php 
	echo "<h1>This page was created by displayPostGetData.php</h1>";
	
	// Extract the values from the associative array
	// echo "Contents of the \$_POST[] array:<br><pre>";
	// echo var_dump($_POST);
	// echo "</pre>";
	
	if (isset($_POST["txtName"])) {
		$txtName = $_POST["txtName"];
	}
	
	if (isset($_POST["txtEmail"])) {
		$txtEmail = $_POST["txtEmail"];
	}
	
	if (isset($_POST["txtContact"])) {
		$txtContact = $_POST["txtContact"];
	}
		
	// Display the information
	// echo "Contents of the \$_GET[] array:<br><pre>";
	// echo var_dump ($_GET);
	// echo "</pre>";
	
	if( $txtName || $txtEmail || $txtContact) 
	{
		echo "<p>";
		echo "Welcome: ". $txtName. "<br>";
		echo "Your Email is: ". $txtEmail. "<br>";
		echo "Your mobile no. is: ". $txtContact;
		echo "</p>";
	}
	
	// Extract the GET variables
	
?>
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<!-- testError.php - Testing PHP errors
		Andy Bowar
		9/6/2017
	-->
	<title>PHP error testing</title>
</head>

<body>
	<h1>Testing PHP errors</h1>
	
	<!-- Start PHP -->
	<?php
		print("The next line will cause a PHP error. <br>");
		printalalala("This ain't no function, bro.");
		print("This will also not be displayed because of the previous error. <br>");
	?>
	
</body>
</html>
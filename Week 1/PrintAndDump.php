<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<!-- testPrintAndDump.php
		Andy Bowar
		9/6/2017
	-->
	<title>PHP Print/Dump</title>
</head>

<body>
	<h1>Testing PHP Print/Dump</h1>
	
	<!-- Start PHP -->
	<?php
		// Set up variables
		$userName = "abowar";
		$userAge = "27";
		$userEmployed = false;
		$familyMembers = array("Emily Bowar", "David Bowar", "Rachel Bowar");
		
		// Preformatted text
		echo "<pre>";
		// output label using "\" to prevent PHP parsing
		echo "\$userName: ";
		// output meta data (data stored in variables)
		var_dump($userName);
		
		echo "\$userAge: ";
		var_dump($userAge);
		
		echo "\userEmployed: ";
		var_dump($userEmployed);
		
		echo "Contents of \$familyMembers: ";
		print_r($familyMembers);
		echo "<br>";
		echo $familyMembers . "<br>";
		echo "\$doesNotExist: " . $doesNotExist . "<br>";
		echo "<pre>";
	?>
	
</body>
</html>
<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8">
<!-- arrayLoopResponse.php - demonstrate looping through arrays
  Student Name
  Written:   Current Date 
  -->
 <title>Looping</title>
 <link rel="stylesheet" type="text/css" href="displayData.css">
</head>
<body>
<div id="frame">
   <h1>Displaying Arrays</h1>

<?php 
   // Display the $_POST[ ] array using foreach loop
   echo "<strong>\$_POST[] using a foreach loop:</strong><br>\n";
   foreach ($_POST as $thisKey => $thisValue) {
	   echo "<strong>Key:</strong> $thisKey <strong>Value:</strong> $thisValue<br>\n";
   }
   echo("<hr /> \n\n");
   
   // Set up an indexed array
   $friendList = array("Micah", "Chris", "Rachel", "Emily");
   
   // Display the indexed array using a for loop
   echo "<strong>\$friendList using a for loop:</strong><br>\n";
   for($index=0; $index<count($friendList); $index++) {
	   echo "index = $index contains the name = $friendList[$index].<br>\n";
   }
   echo("<hr />\n\n");
   
   // Display the array using foreach loop
   echo "<strong>\$friendList using a foreach loop:</strong><br />\n";
   foreach ($friendList as $thisKey => $thisValue) {
	   echo "<strong>Key:</strong> $thisKey <strong>Value:</strong> $thisValue<br />\n";
	}
	echo("<hr />\n\n");
   
   
   // Set up an associative array of capital cities and country pairs using the => array operator
   $capitals = array("Paris" => "France", "Minneapolis" => "Minnesota", "Reykjavik" => "Iceland");
   
   echo "<strong>Capital Cities</strong><br>\n";
   echo "<ul>\n";
   
   foreach($capitals as $thisCity => $thisCountry) {
	   echo "<li>$thisCity, $thisCountry</li>";
   }
   
   echo "</ul>\n\n";
   

   
   
?>
</div>
</body>
</html>
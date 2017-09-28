<!DOCTYPE html>
<html lang="en">
<head>	
   <meta charset="utf-8" />    
   <title>Casting Demo</title>
</head>
<body>
   <h1>Casting Demo</h1>
   
   <?PHP

	$price =  123.999999;
	$resultCast =  0;
	$resultSetType = 0;  
	
	echo '$price is: ' . $price . '. It is of type: ' . getType($price) . '.<br />';
	
	// #1 double to int
	echo '<h2> Casting - double to int</h2>';
	$resultCast = (int)$price;
	echo '$price cast to an int is: ' . $resultCast . '<br>';

	// Conversions
	$myString = "This is a string.";
	$myStringOfNumbers = "1234.5678";
	
	//CAST string to int
	echo '$myString: ' . $myString . ' Type: ' . getType($myString) . '<br>';
	echo '$myString CAST as an int: ' . (int)$myString . ' Type: ' . getType($myString) . '<br>';
	
	
   
    ?>
</body>
</html>
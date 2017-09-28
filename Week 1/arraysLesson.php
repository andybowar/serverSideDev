<?php
 // Tell server that you will be tracking session variables
 session_start( );
?>
<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- webFormProject.php
  Andy Bowar
  Written:   9/8/17 
  -->
 <title>Web Form Project</title>
</head>

<body>

<?php
	// This allows you call $self on as the action on a 
	// form instead of the file name
	$self = $_SERVER['PHP_SELF'];
	
	if(array_key_exists('hidSubmitFlag', $_POST)) {
		echo "<h2>Welcome back!</h2>";
		// Look at hidden submitFlag to determine next action
		$submitFlag = $_POST['hidSubmitFlag'];
		echo("DEBUG: hidSubmitFlag is: " . $submitFlag . "<br>");
		
		// Restore the array in the SESSION variable
		$invenArray = unserialize(urldecode($_SESSION['serializedArray']));
		
		switch($submitFlag) {
			case "99": deleteRecord();
			case "01": addRecord();
			break;
		}
	}
	else {
		
		echo("<h2>Welcome to the inventory page!");
	
		// Create array for first time visitor
		$invenArray = array ();
		$invenArray[0][0] ="1111";
		$invenArray[0][1] ="Rose";
		$invenArray[0][2] ="1.95";
		$invenArray[0][3] ="100";
		
		$invenArray[1][0] ="2222";
		$invenArray[1][1] ="Dandelion Tree";
		$invenArray[1][2] ="2.95";
		$invenArray[1][3] ="200";
		
		$invenArray[2][0] ="3333";
		$invenArray[2][1] ="Crabgrass Bush";
		$invenArray[2][2] ="3.95";
		$invenArray[2][3] ="300";
		
		//Save this array as a serialized session variable
		$_SESSION ['serializedArray'] = urlencode(serialize($invenArray));
		
		// echo("DEBUG: invenArray:");
		// var_dump($invenArray);
		// echo("<br><br>");
	}

 /* FUNCTIONS BELOW */

function addRecord ()
{
	global $invenArray;
	
	//Add the new information into the array
	$invenArray[] = array($_POST['txtPartNo'], $_POST['txtDescr'], $_POST['txtPrice'], $_POST['txtQty']);
	
	sort($invenArray);
	 $_SESSION['serializedArray'] = urlencode(serialize($invenArray));	
	
	
} //end of addRecord()

function deleteRecord( )
{
	global $invenArray;
	global $deleteMe;
	
	//Get the selected index from the listItem
	$deleteMe = $_POST['listItem'];
	// Remove theselected index from the array
	unset($invenArray[$deleteMe]);
	// Save the update array in its session variable
	$_SESSION['serializedArray'] = urlencode(serialize($invenArray));
	echo "<h2>Record deleted</h2>";	
} // end of deleteRecord( )

function displayInventory( )
{
	global $invenArray;
	echo("<table border='1'>");
	
	// display the header
	echo "<tr>";
	echo "<th>Part no.</th>";
	echo "<th>Desc.</th>";
	echo "<th>Price</th>";
	echo "<th>Qty</th>";
	echo "</tr>";
	
	// Walk through each record or row
	if ($invenArray ) { 
	foreach ($invenArray as $record) {
		echo "<tr>";
		// for each column in the row
		foreach($record as $value) {
			echo "<td>$value</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
	} else {
		echo "Array is empty.";
	}
} // end of displayInventory( )

/* END OF FUNCTIONS */

?>

<h1>Plants 'n' stuff</h1>

<p>Plants:<br>
	<?php displayInventory( ); ?>
</p>
	
<form action="<?php $self ?>" method="POST" name="formAdd">
	<fieldset>
		<input type="text" name="txtPartNo" id="txtPartNo" placeholder="Part No." size="5" />
		<br /><br />
		
		<input type="text" name="txtDescr" id="txtDescr" placeholder="Description" />
		<br /><br />
		
		<input type="text" name="txtPrice" id="txtPrice" placeholder="price" />
		<br /><br />
		
		<input type="text" name="txtQty" id="txtQty" placeholder="Qty" size="5" />
		<br /><br />
		<!-- This field is used to determine if the page has been viewed already
		Code 01 = Add
		-->
		<input type='hidden' name='hidSubmitFlag' id='hidSubmitFlag' value='01' />
		<input name="btnSubmit" type="submit" value="Add this information" />
	</fieldset>
</form>	

<br>	
	
<form action="<?php $self ?>" method="POST" name="formDelete">
	<fieldset>
		Select a product:
		<select name="listItem" size="1">
			<?php
			//Populate list box using data from the array
			foreach($invenArray as $index => $listRecord) {
				// Make the "value" be the index and the text displayed the "description" from the array
				// The index will be used by deleteRecord()
				echo "<option value=" . $index . ">" . $listRecord[1] . "</option>\n";
				}
			?>
		</select>
		<!-- This field is used to determine if the page has been 
		viewed already Code 99 = Delete
		-->
		<input type="hidden" name="hidSubmitFlag" id="hidSubmitFlag" value="99" />
		<br /><br />
		<input name="btnSubmit" type="submit" value="Delete" />
	</fieldset>
</form>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</body>
</html>
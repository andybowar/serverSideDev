<?php
	// Create array
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
	
	echo("DEBUG: invenArray:");
	var_dump($invenArray);
	echo("<br><br>");


 /* FUNCTIONS FUNCTIONS FUNCTIONS */

function addRecord ()
{
	echo("addRecord() has not been written yet.");
} //end of addRecord()

function deleteRecord( )
{
 echo("deleteRecord( ) has not been written yet.");
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
		echo "array is empty.";
	}
} // end of displayInventory( )


?>
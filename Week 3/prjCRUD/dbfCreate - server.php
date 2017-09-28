<?php
 // Tell server that you will be tracking session variables
 session_start( );
?>
<!doctype html>


<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- index.php
	 Andy Bowar
     Written:   9/9/17 
  -->
 <title>Analytics</title>
</head>

<body>

<div class="container">

<h1>Below is a table that displays analytics data populated by a database.</h1>
<br>
<?php

// This allows you call $self on as the action on a 
// form instead of the file name
$self = $_SERVER['PHP_SELF'];

// Set up connection constants
// Using default username and password for AMPPS  
define("SERVER_NAME","sql209.byethost7.com");
define("DBF_USER_NAME", "b7_19077761");
define("DBF_PASSWORD", "htvxbfnm");
define("DATABASE_NAME", "b7_19077761_analytics");

// Create connection object
$conn = new mysqli(SERVER_NAME, DBF_USER_NAME, DBF_PASSWORD);

// Start with a new database to start primary keys at 1
$sql = "DROP DATABASE " . DATABASE_NAME;
runQuery($sql, "DROP " . DATABASE_NAME, true);
	
/*****************
* CREATE DATABASE
******************/
	function createDatabase() {
		global $conn;
		$sql = "CREATE DATABASE IF NOT EXISTS " . DATABASE_NAME;
		if ($conn->query($sql) === TRUE) {
			echo "The database " . DATABASE_NAME . " exists or was created successfully!<br /><br>";
		} else {
			echo "Error creating database " . DATABASE_NAME . ": " . $conn->error;
			echo "<br />";
		}
	}
// Create the database if it doesn't already exist
createDatabase();

// Select the database
$conn->select_db(DATABASE_NAME);

/********************************
* CREATE QUERY FUNCTION *
*********************************/	
	function runQuery($sql, $msg, $echoSuccess) {
		global $conn;
			
		// run the query
		if ($conn->query($sql) === TRUE) {
			if($echoSuccess) {
				echo $msg . " successful.<br />";
			}
		} else {
			echo "<strong>Error when: " . $msg . "</strong> using SQL: " . $sql . "<br />" . $conn->error;
		}   
	}
	
/********************************
* CREATE CONNECTION TO DATABASE *
*********************************/
	function createConnection( ) {
		global $conn;
		// Create connection object
		$conn = new mysqli(SERVER_NAME, DBF_USER_NAME, DBF_PASSWORD);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		// Select the database
		$conn->select_db(DATABASE_NAME);
	} 	// end of createConnection
	
	
	
/*****************
* CREATE TABLES
******************/
$sql = "CREATE TABLE IF NOT EXISTS device (
        device_id INT(6) AUTO_INCREMENT PRIMARY KEY, 
        make      VARCHAR(25),
        model     VARCHAR(25)
        )";
runQuery($sql, "Table:device", false);

$sql = "CREATE TABLE IF NOT EXISTS category (
        cat_id 	INT(6) AUTO_INCREMENT PRIMARY KEY, 
		catName	VARCHAR(25)
        )";
runQuery($sql, "Table:category", false);

$sql = "CREATE TABLE IF NOT EXISTS action (
        action_id 	INT(6) AUTO_INCREMENT PRIMARY KEY, 
        actionName  VARCHAR(50)
        )";
runQuery($sql, "Table:action", false);

$sql = "CREATE TABLE IF NOT EXISTS analytic (
        device_id 	INT(6), 
		cat_id 		INT(6), 
		action_id 	INT(6),
		num_events	INT(6)
        )";
runQuery($sql, "Table:analytic", false);



/***********************************
* POPULATE TABLES USING SAMPLE DATA
***********************************/

// Populate device table
$deviceArray = array (
	array("Samsung", "Galaxy S6"),
	array("Samsung", "Galaxy S7"),
	array("Google", "Nexus"),
	array(NULL, NULL),
	array("HTC", "One"),
	array("Google", "Pixel"),
	array("Apple", "iPhone SE"),
	array(NULL, NULL),
	array("Apple", "iPhone 7 Plus"),
	array("Apple", "iPad Mini 2"),
	array(NULL, NULL),
	array("Motorola", "Moto"),
	array(NULL, NULL),
	array("Apple", "iPhone 5"),
	array("LG", "Tribute")
	);

foreach($deviceArray as $device) {
	$sql = "INSERT INTO device (device_id, make, model) "
		. "VALUES (NULL, '" . $device[0] . "', '" 
					  . $device[1] . "')";
runQuery($sql, "Insert value $device[1]", false);
}



// Populate category table
$categoryArray = array (
	array("Email"),
	array("Calendar"),
	array("Web Browser"),
	array("Settings"),
	array("Notifications"),
	array("Camera"),
	array(NULL),
	array(NULL)
	);

foreach($categoryArray as $category) {
	$sql = "INSERT INTO category (cat_id, catName) " 
		. "VALUES (NULL, '" . $category[0] . "')" ;					  
runQuery($sql, "Insert value $category[1]", false);
}

// Populate action table
$actionArray = array (
	array("clicked home button"),
	array("tapped \'compose\'"),
	array("view inbox"),
	array("took photo"),
	array("changed camera type"),
	array("dismissed notification"),
	array("increased screen brightness"),
	array("changed ringtone"),
	array(NULL)
	);

foreach($actionArray as $action) {
	$sql = "INSERT INTO action (action_id, actionName) " 
		. "VALUES (NULL, '" . $action[0] . "')" ;					  
runQuery($sql, "Insert value $action[1]", false);
}

//var_dump($deviceArray);
// Populate analytic table
foreach($deviceArray as $analytic) {
	buildAnalytic($analytic[0], $analytic[1], "Email", "tapped \'compose\'");
	buildAnalytic($analytic[0], $analytic[1], "Calendar", "clicked home button");
	buildAnalytic($analytic[0], $analytic[1], "Email", "tapped \'compose\'");
	buildAnalytic($analytic[0], $analytic[1], "Camera", "took photo");
	buildAnalytic($analytic[0], $analytic[1], "Notifications", "dismissed notification");
}



/***********************************
* Function to build analytic table
************************************/
function buildAnalytic($make, $model, $categoryName, $actionName) {
	global $conn;
	
	// Determine device
	$sql = "SELECT device_id FROM device 
           WHERE make='" . $make 
           . "' AND model='" . $model . "'";
	$result = $conn->query($sql);
	$record = $result->fetch_assoc();
	$deviceId = $record['device_id'];
	
	// Determine category
	$sql = "SELECT cat_id FROM category WHERE catName='" . $categoryName . "'";
	$result = $conn->query($sql);
	$record = $result->fetch_assoc();
	$categoryId = $record['cat_id'];
	
	// Determine action
	$sql = "SELECT action_id FROM action WHERE actionName='" . $actionName . "'";
	$result = $conn->query($sql);
	$record = $result->fetch_assoc();
	$actionId = $record['action_id'];
	
	// Insert the data
	$sql = "INSERT INTO analytic (action_id, cat_id, device_id, num_events) 
         VALUES (" . $actionId . ", " . $categoryId . ", " . $deviceId . ", '12')";
    runQuery($sql, "Insert " . $actionId . " and " . $categoryId . " and " . $deviceId, false);
}

/*****************
* DISPLAY TABLES
******************/
function displayData($result, $sql) {
	if ($result->num_rows > 0) {
		echo "<table class='table'>";
		// print headings (field names)
		$heading = $result->fetch_assoc( );
		echo "<tr>\n";
		// print field names 
		foreach($heading as $key=>$value){
			echo "<th>" . $key . "</th>\n";
		}
		echo "</tr>\n";
		
		// Print values for the first row
		echo "<tr>\n";
		foreach($heading as $key=>$value){
			if (empty($value)) {
				echo "<td><em>NULL</em></td>\n";
			} elseif (strpos($value, '0')) {
				echo "<td><em>NULL</em></td>\n";
			} else {
				echo "<td>" . $value . "</td>\n";
			}
		}
					
		// output rest of the records
		while($row = $result->fetch_assoc()) {
				//var_dump($row);
				//echo "<br />";
				echo "<tr>\n";
				// print data
				foreach($row as $key=>$value) {
					if (empty($value)) {
						echo "<td><em>NULL</em></td>\n";
					} elseif (strlen($value) > 0 && strlen(trim($value)) == 0) {
						echo "<td><em>NULL</em></td>\n";
					} else {
						echo "<td>" . $value . "</td>\n";
					}
					//var_dump($value);
				}
			
			echo "</tr>\n";
		}
		echo "</table>\n";
	} else {
		echo "<strong>zero results using SQL: </strong>" . $sql;
	}
}

function displayAnalyticsTable( ) {
	global $conn;
	$sql = "SELECT 
				CONCAT(make, ' ', model) as 'Device'
				,catName AS 'Category'
				,actionName AS 'Action'
				,num_events AS 'Number of Events'
			
			FROM `analytic` as an
			
			
			INNER JOIN action AS ac on ac.action_id = an.action_id
			INNER JOIN category AS c on c.cat_id = an.cat_id
			INNER JOIN device AS d on d.device_id = an.device_id";
	$result = $conn->query($sql);
	displayData($result, $sql);
}

displayAnalyticsTable();

// Close the database
$conn->close();



/* END OF FUNCTIONS */

?>



</div>

</body>
</html>
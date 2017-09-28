<!DOCTYPE html>
<html lang='en'>
	<head>
	<meta charset="utf=8" />
	<title>Sun Run Create</title>
	</head>
<body>
<h1>Sun Run Create Test Page</h1>
<?php


// Set up connection constants
//Using default username and password for AMPPS
define("SERVER_NAME", "localhost");
define("DBF_USER_NAME", "root");
define("DBF_PASSWORD", "mysql");
define("DATABASE_NAME", "sunRun");

//Create connection object
$conn = new mysqli(SERVER_NAME, DBF_USER_NAME, DBF_PASSWORD);

//Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

//Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS " . DATABASE_NAME;
//if ($conn->query($sql) === TRUE) {
//	echo "The database" . DATABASE_NAME . " exists or was created successfully!<br>";
//} else {
//	echo "Error creating database " . DATABASE_NAME . ": " . $conn->error;
//	echo "<br>";
//}
runQuery($sql, "Creating " . DATABASE_NAME, false);


// Select the database
$conn->select_db(DATABASE_NAME);

/********************************
* Create the tables
*********************************/
// Create Table: runner
$sql = "CREATE TABLE IF NOT EXISTS runner (
		id_runner INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		fName	  VARCHAR(25) NOT NULL,
		lName	  VARCHAR(25) NOT NULL,
		gender	  VARCHAR(10),
		phone	  VARCHAR(10)
		)";
		
runQuery($sql, "Creating runner: ", false);

// Create Table: race
$sql = "CREATE TABLE IF NOT EXISTS race (
	    id_race 	INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		raceName	VARCHAR(25) NOT NULL,
		entranceFee SMALLINT
		);";
		
runQuery($sql, "Creating race: ", false);		

// Create Table:runner_race if it doesn't exist
// One racer can run multiple races
$sql = "CREATE TABLE IF NOT EXISTS race_runner (
		id_race 	INT(6),
		id_runner 	INT(6),
		bibNumber 	INT(6),
		paid      	BOOLEAN
		)"; 
runQuery($sql, "Table:runner_race", false);

// Create Table:sponsor
$sql = "CREATE TABLE IF NOT EXISTS sponsor (
		id_sponsor      INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		sponsorName     VARCHAR(50) NOT NULL,
		id_runner       INT(6)
		)";
runQuery($sql, "Table:sponsor", false);


/**************************************************
* Populate Tables Using Sample Data
* This data will later be collected using a form.
***************************************************/
// Populate Table:runner
//$sql = "INSERT INTO runner (fName, lName, gender, phone) " .
//		"VALUES('Johnny', 'Hayes', 'male', '1234567890')";
//if ($conn->query($sql) === TRUE) {
//	echo "New record created successfully.<br>";
//} else {
//	echo "<strong>Error:</strong>" . $sql . "<br>" . $conn->error;
//}

$runnerArray = array(
	array("Johnny", "Hayes", "male", "1234567890"),
	array("Bobby", "Jerkins", "male", "2254698736"),
	array("James", "Clark", "male", "5648949849"),
	array("Marie", "Ledru", "female", "65498498154"),
	);
	
foreach($runnerArray as $runner) {
	echo $runner[0] . " " . $runner[1] . "<br>";
	$sql = "INSERT INTO runner (fName, lName, gender, phone) "
		. "VALUES ('" . $runner[0] . "', '"
		. $runner[1] . "', '"
		. $runner[2] . "', '"
		. $runner[3] . "')";
	echo "\$sql string is: " . $sql . "<br>";
	runQuery($sql, "Record inserted for: ", $runner[1], false);
}
// Populate Table:race
$raceArray = array(
	array("10k", 46),
	array("5k", 46),
	array("Marathon", 85),
	array("Half Marathon", 75)
	);

foreach($raceArray as $race) {
	echo $race[0] . " " . $race[1] . "<br>";
	$sql = "INSERT INTO race (id_race, raceName, entranceFee) "
		. "VALUES (NULL, '" . $race[0] . "', '" 
       . $race[1] . "')"; 
	   runQuery($sql, "New record insert $race[1]", false);
}
	
// Populate Table:sponsor
$sponsorArray = array(
   array("Nike",  2),
   array("Western Hospital", 3),
   array("House of Heroes", 4)
   );
   
foreach($sponsorArray as $sponsor) {
   $sql = "INSERT INTO sponsor (id_sponsor, sponsorName, id_runner) "
       . "VALUES (NULL, '" . $sponsor[0] . "', '" 
       . $sponsor[1] . "')";
       
   //echo "\$sql string is: " . $sql . "<br />";
   runQuery($sql, "New record insert $sponsor[0]", false);
}

// Populate Table:runner_race
// Determine id_runner for Robert Fowler
/*$sql = "SELECT id_runner FROM runner WHERE fName='Robert' AND lName='Fowler'";
$result = $conn->query($sql);
$record = $result->fetch_assoc();
//echo '$record: <pre>';
// print_r($record);
// echo '</pre>';
$thisRunner = $record['id_runner'];
//echo '$thisRunner: '. $thisRunner . '<br />';

// Determine id_race for Half Marathon
$sql = "SELECT id_race FROM race WHERE raceName='Half Marathon'";
$result = $conn->query($sql);
$record = $result->fetch_assoc();
$thisRace = $record['id_race'];
//echo '$thisRace: ' . $thisRace . '<br />';*/

// Add each sample runner to the Marathon and Half Marathon
foreach($runnerArray as $runner) {
	buildRunnerRace($runner[0], $runner[1], "Marathon");
	buildRunnerRace($runner[0], $runner[1], "Half Marathon");
}

// Check to make sure runner hasn't already registered for this race
$sql = "SELECT id_race FROM runner_race WHERE id_race = " . $thisRace;
if ($result = $conn->query($sql)) {
   //determine number of rows result set 
   $row_count = $result->num_rows;
   if($row_count > 0) {
      echo "Runner " . $thisRunner
      . " has already registered for race " 
      . $thisRace . "<br />";
   } else { // Not a duplicate
      $sql = "INSERT INTO runner_race (id_runner, id_race, bibNumber, paid) 
         VALUES (" . $thisRunner . ", " . $thisRace . ", 1234, true)";
      runQuery($sql, "Insert " . $thisRunner . " and " . $thisRace, true);
   } // end of if($row_count)
} // end if($result)


// Add in extra runners who aren't registered for a race yet

/*************************************************
* Display the tables
**************************************************/
// Table:runner

// Table:race

// Table:sponsor

// Close the database
$conn->close();

/**************************************************************************
* buildRunnerRace() - Register runner for specific races using sample data.
* Sets up a table with two foreign keys
* connecting Table:runner to Table:race
* Parameters: $fName 	- runner's first name
*			  $lName 	- runner's last name	
*			  $thisRace - register this runner to this race
***************************************************************************/
function buildRunnerRace($fName, $lName, $thisRace) {
	global $conn;
   
   // Populate Table:runner_race
   // Determine id_runner
   $sql = "SELECT id_runner FROM runner 
           WHERE fName='" . $fName 
           . "' AND lName='" . $lName . "'";
   $result = $conn->query($sql);
   $record = $result->fetch_assoc();
   $runnerID = $record['id_runner'];
   //echo '$thisRunner: ' . $thisRunner;
   
   // Determine id_race
   $sql = "SELECT id_race FROM race WHERE raceName='" . $thisRace . "'";
   $result = $conn->query($sql);
   $record = $result->fetch_assoc();
   $raceID = $record['id_race'];
   //echo ' -- $raceID: ' . $raceID . '<br />';
      
   // Check to make sure runner hasn't already registered for this race
   $sql = "SELECT id_race FROM race_runner 
     WHERE id_race = " . $raceID 
     . " AND id_runner = " . $runnerID;
   $result = $conn->query($sql);
   
   /* determine number of rows result set */
   $row_count = $result->num_rows;
   if($row_count > 0) {
      echo "Runner " . $thisRunner
      . " has already registered for race_runner " 
      . $thisRace . "<br />";
   } else { // Not a duplicate
      $sql = "INSERT INTO race_runner (id_runner, id_race, bibNumber, paid) 
         VALUES (" . $runnerID . ", " . $raceID . ", 1234, true)";
      runQuery($sql, "Insert " . $runnerID . " and " . $thisRace, false);
   } // end if($result)
   
	
} // end of buildRunnerRace()


/**************************************************************************
* displayResult() - Execute a query and display the result
*	Parameters: $rs  - result set to display as 2D array
*				$sql - SQL string used to display an error msg
***************************************************************************/
function displayResult($result, $sql) {
	
}

/**************************************************************************
* runQuery() - Execute a query and display message
*	Parameters: $sql - SQL String to be executed.
*				$msg - Text of message to display on success or error
*	___$msg___ successful. Error when: __$msg____ using SQL: ___$sql___.
*				$echoSuccess - boolean True=Display message on success
***************************************************************************/
function runQuery($sql, $msg, $echoSuccess) {
	global $conn;
	
	// run the query
	if ($conn->query($sql) === TRUE) {
		if ($echoSuccess) {
			echo $msg . " successful.<br>";
		}
	} else {
	echo "Error when" . $msg . " using SQL: " . $sql . "<br>" . $conn->error;
	}	
}
?>

</body>
</html>










































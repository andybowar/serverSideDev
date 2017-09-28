<!DOCTYPE html>
<html lang='en'>
   <head>
   <meta charset="utf-8" />
   <title>Analytics JOINs</title>
   </head>
<body>
<h1>Analytics Join Testing</h1>
<?PHP
/* analyticsJoins.php - Experiment with SQL JOINS
             
   Written by Andy Bowar
   Written  9/24/17
*/
   
// Set up connection constants
// Using default username and password for AMPPS  
define("SERVER_NAME","sql209.byethost7.com");
define("DBF_USER_NAME", "b7_19077761");
define("DBF_PASSWORD", "htvxbfnm");
define("DATABASE_NAME", "b7_19077761_analytics");

// Create connection object
$conn = new mysqli(SERVER_NAME, DBF_USER_NAME, DBF_PASSWORD);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Select the database
$conn->select_db(DATABASE_NAME);

// Display Table:device
echo "All Fields FROM device<br />";
$sql = "SELECT * FROM device";
$result = $conn->query($sql);
displayResult($result, $sql);
echo "<br />";

// Display specific field names using aliases
echo "fName and lName FROM device<br />";
echo "Using aliases<br />";
// FROM runner";
$sql = "SELECT make AS 'Make', model AS 'Model' FROM device";
$result = $conn->query($sql);
displayResult($result, $sql);
echo "<br />";

// Display Table:category
echo "All Fields FROM category<br />";
echo "(Not every category is used as an analytic.)<br />";
$sql = "SELECT * FROM category";
$result = $conn->query($sql);
displayResult($result, $sql);
echo "<br />"; 

// INNER JOIN THREE TABLES
echo "INNER JOIN 3 TABLES<br />";
echo "INNER JOIN from device, category, and action.<br />";
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
displayResult($result, $sql);
echo "<br />"; 

// LEFT OUTER JOIN
echo "LEFT OUTER JOIN (Left table: device)<br />";
$sql = "SELECT d.device_id AS ID, make as Make, model AS Model, actionName as Action
FROM device AS d
LEFT OUTER JOIN action AS a
ON a.action_id = d.device_id";
$result = $conn->query($sql);
displayResult($result, $sql);
echo "<br />";

// RIGHT OUTER JOIN
echo "RIGHT OUTER JOIN (Right table: action)<br />";
$sql = "SELECT d.device_id AS ID, make as Make, model AS Model, actionName as Action
FROM device AS d
RIGHT OUTER JOIN action AS a
ON a.action_id = d.device_id";
$result = $conn->query($sql);
displayResult($result, $sql);
echo "<br />";

// Close the database
$conn->close();

/********************************************
 * displayResult( ) - Execute a query and display the result
 * Parameters: $rs  - Result set to display as 2D array
 *             $sql - SQL string used to display an error msg
 ********************************************/
function displayResult($result, $sql) {
    if ($result->num_rows > 0) {
		echo "<table border='1'>\n";
			// print headings (field names)
			$heading = $result->fetch_assoc( );
			echo "<tr>\n";
			// Print field names as table headings
			foreach($heading as $key=>$value){
				echo "<th>" . $key . "</th>\n";
			}
			echo "</tr>";
			// Print the values for the first row
			echo "<tr>";
			foreach($heading as $key=>$value){
				if (empty($value)) {
					echo "<td><em>NULL</em></td>\n";
				} elseif (strlen($value) > 0 && strlen(trim($value)) == 0) {
					echo "<td><em>NULL</em></td>\n";
				} else {
					echo "<td>" . $value . "</td>\n";
				};
			}

        // output rest of the records
        while($row = $result->fetch_assoc()) {
            //print_r($row);
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
					};
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
    // No results
    } else {
       echo "<strong>zero results using SQL: </strong>" . $sql;
    } 
   
} // end of displayResult( )

/********************************************
 * runQuery( ) - Execute a query and display message
 *    Parameters:  $sql         -  SQL String to be executed.
 *                 $msg         -  Text of message to display on success or error
 *     ___$msg___ successful.    Error when: __$msg_____ using SQL: ___$sql____.
 *                 $echoSuccess - boolean True=Display message on success
 ********************************************/
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
} // end of runQuery( ) 
?>

</body>
</html>
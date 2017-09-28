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
<?php
	// Define constants
	define('BATH_TOWEL', '0');
	define('WASH_CLOTH', '1');
	define('FIRM_PILLOW', '2');
	define('SHOWER_CURTAIN', '3');
	define('PANTRY_ORGANIZER', '4');
	define('STORAGE_JAR', '5');
	define('COMFORTER', '6');
	define('ROLLAWAY_BED', '7');
	$tableDisplay = BATH_TOWEL;
	$sql =
	'SELECT *
	
	FROM `product` 
	
	INNER JOIN color on color.colorId = product.colorId
	INNER JOIN department on department.departmentId = product.departmentId
	INNER JOIN departmentManager on departmentManager.deptManagerId = product.deptManagerId
	INNER JOIN manufacturer on manufacturer.manufacturerId = product.manufacturerId
	INNER JOIN manufacturerWebsite on manufacturerWebsite.manufacturerUrlId = product.manufacturerUrlId
	INNER JOIN price on price.priceId = product.priceId
	INNER JOIN productPageURL on productPageURL.urlId = product.urlId
	INNER JOIN quantity on quantity.quantityId = product.quantityId
	 
	WHERE productName like "bath%"';
	
	// This creates a connection to the database using the given criteria

	
	echo '<h1>Welcome to the products page!</h1><br>';
	
	// Below is a switch to determine which query to use, based on the option chosen from the dropdown menu
	if(isset($_POST['productList'])) {
			//Save selected item
			$selection = $_POST['productList'];
			switch($selection) {
				case "bathTowel": {
					$tableDisplay=BATH_TOWEL;
					$sql = 
					'SELECT *
					
					FROM `product` 
					
					INNER JOIN color on color.colorId = product.colorId
					INNER JOIN department on department.departmentId = product.departmentId
					INNER JOIN departmentManager on departmentManager.deptManagerId = product.deptManagerId
					INNER JOIN manufacturer on manufacturer.manufacturerId = product.manufacturerId
					INNER JOIN manufacturerWebsite on manufacturerWebsite.manufacturerUrlId = product.manufacturerUrlId
					INNER JOIN price on price.priceId = product.priceId
					INNER JOIN productPageURL on productPageURL.urlId = product.urlId
					INNER JOIN quantity on quantity.quantityId = product.quantityId
					
					WHERE productName like "bath%"';
					break;
				}
				
				case "washCloth": {
					$tableDisplay=WASH_CLOTH;
					$sql = 
					'SELECT *
					
					FROM `product` 
					
					INNER JOIN color on color.colorId = product.colorId
					INNER JOIN department on department.departmentId = product.departmentId
					INNER JOIN departmentManager on departmentManager.deptManagerId = product.deptManagerId
					INNER JOIN manufacturer on manufacturer.manufacturerId = product.manufacturerId
					INNER JOIN manufacturerWebsite on manufacturerWebsite.manufacturerUrlId = product.manufacturerUrlId
					INNER JOIN price on price.priceId = product.priceId
					INNER JOIN productPageURL on productPageURL.urlId = product.urlId
					INNER JOIN quantity on quantity.quantityId = product.quantityId
					
					WHERE productName like "wash%"';
					break;
				}
				
				case "showerCurtain": {
					$tableDisplay=SHOWER_CURTAIN;
					$sql = 
					'SELECT *
					
					FROM `product` 
					
					INNER JOIN color on color.colorId = product.colorId
					INNER JOIN department on department.departmentId = product.departmentId
					INNER JOIN departmentManager on departmentManager.deptManagerId = product.deptManagerId
					INNER JOIN manufacturer on manufacturer.manufacturerId = product.manufacturerId
					INNER JOIN manufacturerWebsite on manufacturerWebsite.manufacturerUrlId = product.manufacturerUrlId
					INNER JOIN price on price.priceId = product.priceId
					INNER JOIN productPageURL on productPageURL.urlId = product.urlId
					INNER JOIN quantity on quantity.quantityId = product.quantityId
					
					WHERE productName like "shower%"';
					break;
				}
				
				case "pantryOrganizer": {
					$tableDisplay=PANTRY_ORGANIZER;
					$sql = 
					'SELECT *
					
					FROM `product` 
					
					INNER JOIN color on color.colorId = product.colorId
					INNER JOIN department on department.departmentId = product.departmentId
					INNER JOIN departmentManager on departmentManager.deptManagerId = product.deptManagerId
					INNER JOIN manufacturer on manufacturer.manufacturerId = product.manufacturerId
					INNER JOIN manufacturerWebsite on manufacturerWebsite.manufacturerUrlId = product.manufacturerUrlId
					INNER JOIN price on price.priceId = product.priceId
					INNER JOIN productPageURL on productPageURL.urlId = product.urlId
					INNER JOIN quantity on quantity.quantityId = product.quantityId
					
					WHERE productName like "pantry%"';
					break;
				}
				
				case "storageJar": {
					$tableDisplay=STORAGE_JAR;
					$sql = 
					'SELECT *
					
					FROM `product` 
					
					INNER JOIN color on color.colorId = product.colorId
					INNER JOIN department on department.departmentId = product.departmentId
					INNER JOIN departmentManager on departmentManager.deptManagerId = product.deptManagerId
					INNER JOIN manufacturer on manufacturer.manufacturerId = product.manufacturerId
					INNER JOIN manufacturerWebsite on manufacturerWebsite.manufacturerUrlId = product.manufacturerUrlId
					INNER JOIN price on price.priceId = product.priceId
					INNER JOIN productPageURL on productPageURL.urlId = product.urlId
					INNER JOIN quantity on quantity.quantityId = product.quantityId
					
					WHERE productName like "storage%"';
					break;
				}
				
				case "firmPillow": {
					$tableDisplay=FIRM_PILLOW;
					$sql = 
					'SELECT *
					
					FROM `product` 
					
					INNER JOIN color on color.colorId = product.colorId
					INNER JOIN department on department.departmentId = product.departmentId
					INNER JOIN departmentManager on departmentManager.deptManagerId = product.deptManagerId
					INNER JOIN manufacturer on manufacturer.manufacturerId = product.manufacturerId
					INNER JOIN manufacturerWebsite on manufacturerWebsite.manufacturerUrlId = product.manufacturerUrlId
					INNER JOIN price on price.priceId = product.priceId
					INNER JOIN productPageURL on productPageURL.urlId = product.urlId
					INNER JOIN quantity on quantity.quantityId = product.quantityId
					
					WHERE productName like "firm%"';
					break;
				}
				
				case "comforter": {
					$tableDisplay=COMFORTER;
					$sql = 
					'SELECT *
					
					FROM `product` 
					
					INNER JOIN color on color.colorId = product.colorId
					INNER JOIN department on department.departmentId = product.departmentId
					INNER JOIN departmentManager on departmentManager.deptManagerId = product.deptManagerId
					INNER JOIN manufacturer on manufacturer.manufacturerId = product.manufacturerId
					INNER JOIN manufacturerWebsite on manufacturerWebsite.manufacturerUrlId = product.manufacturerUrlId
					INNER JOIN price on price.priceId = product.priceId
					INNER JOIN productPageURL on productPageURL.urlId = product.urlId
					INNER JOIN quantity on quantity.quantityId = product.quantityId
					
					WHERE productName like "comforter"';
					break;
				}
				
				case "rollawayBed": {
					$tableDisplay=ROLLAWAY_BED;
					$sql = 
					'SELECT *
					
					FROM `product` 
					
					INNER JOIN color on color.colorId = product.colorId
					INNER JOIN department on department.departmentId = product.departmentId
					INNER JOIN departmentManager on departmentManager.deptManagerId = product.deptManagerId
					INNER JOIN manufacturer on manufacturer.manufacturerId = product.manufacturerId
					INNER JOIN manufacturerWebsite on manufacturerWebsite.manufacturerUrlId = product.manufacturerUrlId
					INNER JOIN price on price.priceId = product.priceId
					INNER JOIN productPageURL on productPageURL.urlId = product.urlId
					INNER JOIN quantity on quantity.quantityId = product.quantityId
					
					WHERE productName like "roll%"';
					break;
				}
				
				default: echo $selection . 'is not a valid choice from the list.<br>';
			}
		}
	
	// Function to display products table
	function displayProducts( )	{
	
	global $sql;
	global $tableDisplay;
	
	// Check connection to database
	$db = new mysqli('localhost', 'root', 'mysql', 'products');
			
			if($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}
			
			// Get data from database using SQL
			if(!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
	
	
	
	// Switch to choose which data to display based on option chosen from dropdown
	switch($tableDisplay) {
	
		case BATH_TOWEL: {
			// While loop for grabbing information from product table and inserting into table rows
			echo("<table class='table'>");
		
				// Header to display information in table
				echo "<tr>";
				echo "<th>Product Name</th>";
				echo "<th>Color</th>";
				echo "<th>Price</th>";
				echo "<th>On Hand Quantity</th>";
				echo "<th>Product Page</th>";
				echo "<th>Department</th>";
				echo "<th>Department Manager</th>";
				echo "<th>Manufacturer</th>";
				echo "<th>Manufacturer Website</th>";
				echo "</tr>";
					while($row = $result->fetch_assoc()) {
						echo '<tr>';
						echo '<td>' . $row['productName'] . '</td>';
						echo '<td>' . $row['color'] . '</td>';
						echo '<td>' . $row['price'] . '</td>';
						echo '<td>' . $row['quantity'] . '</td>';
						echo '<td>' . $row['url'] . '</td>';
						echo '<td>' . $row['departmentName'] . '</td>';
						echo '<td>' . $row['firstName'] . '</td>';
						echo '<td>' . $row['manufacturerName'] . '</td>';
						echo '<td>' . $row['manufacturerWebsiteUrl'] . '</td>';
						echo '</tr>';				
					}
			echo '</table>';
			break;
		}
		
		case WASH_CLOTH: {
			// While loop for grabbing information from product table and inserting into table rows
			echo("<table class='table'>");
		
				// Header to display information in table
				echo "<tr>";
				echo "<th>Product Name</th>";
				echo "<th>Color</th>";
				echo "<th>Price</th>";
				echo "<th>On Hand Quantity</th>";
				echo "<th>Product Page</th>";
				echo "<th>Department</th>";
				echo "<th>Department Manager</th>";
				echo "<th>Manufacturer</th>";
				echo "<th>Manufacturer Website</th>";
				echo "</tr>";
					while($row = $result->fetch_assoc()) {
						echo '<tr>';
						echo '<td>' . $row['productName'] . '</td>';
						echo '<td>' . $row['color'] . '</td>';
						echo '<td>' . $row['price'] . '</td>';
						echo '<td>' . $row['quantity'] . '</td>';
						echo '<td>' . $row['url'] . '</td>';
						echo '<td>' . $row['departmentName'] . '</td>';
						echo '<td>' . $row['firstName'] . '</td>';
						echo '<td>' . $row['manufacturerName'] . '</td>';
						echo '<td>' . $row['manufacturerWebsiteUrl'] . '</td>';
						echo '</tr>';				
					}
			echo '</table>';
			break;
		}
		
		case SHOWER_CURTAIN: {
			// While loop for grabbing information from product table and inserting into table rows
			echo("<table class='table'>");
		
				// Header to display information in table
				echo "<tr>";
				echo "<th>Product Name</th>";
				echo "<th>Color</th>";
				echo "<th>Price</th>";
				echo "<th>On Hand Quantity</th>";
				echo "<th>Product Page</th>";
				echo "<th>Department</th>";
				echo "<th>Department Manager</th>";
				echo "<th>Manufacturer</th>";
				echo "<th>Manufacturer Website</th>";
				echo "</tr>";
					while($row = $result->fetch_assoc()) {
						echo '<tr>';
						echo '<td>' . $row['productName'] . '</td>';
						echo '<td>' . $row['color'] . '</td>';
						echo '<td>' . $row['price'] . '</td>';
						echo '<td>' . $row['quantity'] . '</td>';
						echo '<td>' . $row['url'] . '</td>';
						echo '<td>' . $row['departmentName'] . '</td>';
						echo '<td>' . $row['firstName'] . '</td>';
						echo '<td>' . $row['manufacturerName'] . '</td>';
						echo '<td>' . $row['manufacturerWebsiteUrl'] . '</td>';
						echo '</tr>';				
					}
			echo '</table>';
			break;
		}
		
		case PANTRY_ORGANIZER: {
			// While loop for grabbing information from product table and inserting into table rows
			echo("<table class='table'>");
		
				// Header to display information in table
				echo "<tr>";
				echo "<th>Product Name</th>";
				echo "<th>Color</th>";
				echo "<th>Price</th>";
				echo "<th>On Hand Quantity</th>";
				echo "<th>Product Page</th>";
				echo "<th>Department</th>";
				echo "<th>Department Manager</th>";
				echo "<th>Manufacturer</th>";
				echo "<th>Manufacturer Website</th>";
				echo "</tr>";
					while($row = $result->fetch_assoc()) {
						echo '<tr>';
						echo '<td>' . $row['productName'] . '</td>';
						echo '<td>' . $row['color'] . '</td>';
						echo '<td>' . $row['price'] . '</td>';
						echo '<td>' . $row['quantity'] . '</td>';
						echo '<td>' . $row['url'] . '</td>';
						echo '<td>' . $row['departmentName'] . '</td>';
						echo '<td>' . $row['firstName'] . '</td>';
						echo '<td>' . $row['manufacturerName'] . '</td>';
						echo '<td>' . $row['manufacturerWebsiteUrl'] . '</td>';
						echo '</tr>';				
					}
			echo '</table>';
			break;
		}
		
		case STORAGE_JAR: {
			// While loop for grabbing information from product table and inserting into table rows
			echo("<table class='table'>");
		
				// Header to display information in table
				echo "<tr>";
				echo "<th>Product Name</th>";
				echo "<th>Color</th>";
				echo "<th>Price</th>";
				echo "<th>On Hand Quantity</th>";
				echo "<th>Product Page</th>";
				echo "<th>Department</th>";
				echo "<th>Department Manager</th>";
				echo "<th>Manufacturer</th>";
				echo "<th>Manufacturer Website</th>";
				echo "</tr>";
					while($row = $result->fetch_assoc()) {
						echo '<tr>';
						echo '<td>' . $row['productName'] . '</td>';
						echo '<td>' . $row['color'] . '</td>';
						echo '<td>' . $row['price'] . '</td>';
						echo '<td>' . $row['quantity'] . '</td>';
						echo '<td>' . $row['url'] . '</td>';
						echo '<td>' . $row['departmentName'] . '</td>';
						echo '<td>' . $row['firstName'] . '</td>';
						echo '<td>' . $row['manufacturerName'] . '</td>';
						echo '<td>' . $row['manufacturerWebsiteUrl'] . '</td>';
						echo '</tr>';				
					}
			echo '</table>';
			break;
		}
		
		case FIRM_PILLOW: {
			// While loop for grabbing information from product table and inserting into table rows
			echo("<table class='table'>");
		
				// Header to display information in table
				echo "<tr>";
				echo "<th>Product Name</th>";
				echo "<th>Color</th>";
				echo "<th>Price</th>";
				echo "<th>On Hand Quantity</th>";
				echo "<th>Product Page</th>";
				echo "<th>Department</th>";
				echo "<th>Department Manager</th>";
				echo "<th>Manufacturer</th>";
				echo "<th>Manufacturer Website</th>";
				echo "</tr>";
					while($row = $result->fetch_assoc()) {
						echo '<tr>';
						echo '<td>' . $row['productName'] . '</td>';
						echo '<td>' . $row['color'] . '</td>';
						echo '<td>' . $row['price'] . '</td>';
						echo '<td>' . $row['quantity'] . '</td>';
						echo '<td>' . $row['url'] . '</td>';
						echo '<td>' . $row['departmentName'] . '</td>';
						echo '<td>' . $row['firstName'] . '</td>';
						echo '<td>' . $row['manufacturerName'] . '</td>';
						echo '<td>' . $row['manufacturerWebsiteUrl'] . '</td>';
						echo '</tr>';				
					}
			echo '</table>';
			break;
		}
		
		case COMFORTER: {
			// While loop for grabbing information from product table and inserting into table rows
			echo("<table class='table'>");
		
				// Header to display information in table
				echo "<tr>";
				echo "<th>Product Name</th>";
				echo "<th>Color</th>";
				echo "<th>Price</th>";
				echo "<th>On Hand Quantity</th>";
				echo "<th>Product Page</th>";
				echo "<th>Department</th>";
				echo "<th>Department Manager</th>";
				echo "<th>Manufacturer</th>";
				echo "<th>Manufacturer Website</th>";
				echo "</tr>";
					while($row = $result->fetch_assoc()) {
						echo '<tr>';
						echo '<td>' . $row['productName'] . '</td>';
						echo '<td>' . $row['color'] . '</td>';
						echo '<td>' . $row['price'] . '</td>';
						echo '<td>' . $row['quantity'] . '</td>';
						echo '<td>' . $row['url'] . '</td>';
						echo '<td>' . $row['departmentName'] . '</td>';
						echo '<td>' . $row['firstName'] . '</td>';
						echo '<td>' . $row['manufacturerName'] . '</td>';
						echo '<td>' . $row['manufacturerWebsiteUrl'] . '</td>';
						echo '</tr>';				
					}
			echo '</table>';
			break;
		}
		
		case ROLLAWAY_BED: {
			// While loop for grabbing information from product table and inserting into table rows
			echo("<table class='table'>");
		
				// Header to display information in table
				echo "<tr>";
				echo "<th>Product Name</th>";
				echo "<th>Color</th>";
				echo "<th>Price</th>";
				echo "<th>On Hand Quantity</th>";
				echo "<th>Product Page</th>";
				echo "<th>Department</th>";
				echo "<th>Department Manager</th>";
				echo "<th>Manufacturer</th>";
				echo "<th>Manufacturer Website</th>";
				echo "</tr>";
					while($row = $result->fetch_assoc()) {
						echo '<tr>';
						echo '<td>' . $row['productName'] . '</td>';
						echo '<td>' . $row['color'] . '</td>';
						echo '<td>' . $row['price'] . '</td>';
						echo '<td>' . $row['quantity'] . '</td>';
						echo '<td>' . $row['url'] . '</td>';
						echo '<td>' . $row['departmentName'] . '</td>';
						echo '<td>' . $row['firstName'] . '</td>';
						echo '<td>' . $row['manufacturerName'] . '</td>';
						echo '<td>' . $row['manufacturerWebsiteUrl'] . '</td>';
						echo '</tr>';				
					}
			echo '</table>';
			break;
		}
	}
	
	//Close DB object
	$db->close;
	}
?>

<form name="formDBF" 
	  action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" 
	  method="POST">
		  
	<h4>What product would you like to view? The first one is selected for you by default.</h4>
	<br>
	<!-- Javascript for submission -->
	<select name="productList" onchange="this.form.submit()">
		<option value="null">Select an item</option>
		<option value="bathTowel">Bath towel</option>
		<option value="washCloth">Wash cloth</option>
		<option value="firmPillow">Firm Pillow</option>
		<option value="showerCurtain">Shower curtain</option>
		<option value="pantryOrganizer">Pantry Organizer</option>
		<option value="storageJar">Storage Jar</option>
		<option value="comforter">Comforter</option>
		<option value="rollawayBed">Rollaway bed</option>
	</select>
	<br>
	<!-- Alternative button in case JavaScript not active -->
	<noscript>
		&nbsp; &nbsp; &nbsp; 
		<input type="submit" name="btnSubmit" value="View The list" />
	</noscript>
	<!-- Use a hidden field to tell server if return visitor -->
	<input type="hidden" name="hidIsReturning" value="true" />
</form>
<br>
<?php displayProducts(); ?>

<p>The steps I took for creating this project:</p>
<ol>
	<li>Design database using excel spreadsheet</li>
	<li>Create tables, keys, and data types in phpMyAdmin as specified by spreadsheet</li>
	<li>Write queries for retrieving data from database</li>
	<li>Write HTML and PHP framework for site</li>
	<li>Incorporate SQL queries into code</li>
</ol>
</div>
</body>
</html>
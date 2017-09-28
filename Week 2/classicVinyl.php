<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <!-- classicVinyl.html - Demonstrate using SELECT to display data
    Student Name
    Written:   Original Date
    Revised:   Current Date
    -->
    <title>Classic Vinyl</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
<div class="container">

	<?php
		// Set up constants for table
		define('SONG', '0');
		define('BAND', '1');
		define('SONG_ALBUM', '2');
		define('ARTIST_BAND', '3');
		$tableFormat = SONG;
		$sql = 'SELECT * FROM song';	
	
		// Is a return visit?
		if(array_key_exists('hidIsReturning',$_POST)) {
			echo '<h1>Welcome back!</h1>';
			var_dump($_POST);
		}	
		
		echo '<br>';
		
		//display list based on selection
		if(isset($_POST['listDisplay'])) {
			//Save selected item
			$selection = $_POST['listDisplay'];
			echo 'DEBUG $selection: ' . $selection . '<br>';
			switch($selection) {
				case "song": {
					$tableFormat=SONG;
					$sql = "SELECT * FROM song";
					break;
				}
				case "band": {
					$tableFormat=BAND;
					break;
				}
				case "songAlbum": {
					$tableFormat=SONG_ALBUM;
					break;
				}
				case "artistBand": {
					$tableFormat=ARTIST_BAND;
					break;
				}
				default: echo $selection . 'is not a valid choice from the list.<br>';
			}
		}
		
		else {
			echo '<h1>Welcome to this website for the first time!</h1>';
		}	
		
		function displayData() {
			global $sql;
			global $tableFormat;
			echo 'DEBUG: $sql: ' . $sql . '<br>';
			// Create a database object
			// PARAMETERS: server, user, password
			$db = new mysqli('localhost', 'root', 'mysql', 'exampleTable');
			
			if($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}
			
			// Get data from database using SQL
			if(!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			
			//Display the list of titles
			//while ($row = $result->fetch_assoc()) {
			//	echo $row['songName'] . '<br>';
			//}
			
			//Display the list of titles in a table
			switch($tableFormat) {
			
				case SONG: {
			
					echo '<h2>Song Title</h2>';
					echo '<table border="2">';
						echo '<tr>';
						echo '<th>Title</th>';
						echo '<th>Price</th>';
						echo '<th>Video</th>';
						echo '<th>Last</th>';
						echo '</tr>';
						
						while($row = $result->fetch_assoc()) {
							echo '<tr>';
							echo '<td><strong>' . $row['songName'] . '</strong></td>';
							echo '<td>' . $row['test1'] . '</td>';
							echo '<td>' . $row['test2'] . '</td>';
							echo '<td>' . $row['test3'] . '</td>';
							echo '</tr>';				
						}
					echo '</table>';
					break;
				}
				
				case BAND: {
					echo 'Table format is: ' . BAND . '<br>';
					break;
				}
			
				case SONG_ALBUM: {
					echo 'Table format is: ' . SONG_ALBUM . '<br />';
					break;
				}
			
				case ARTIST_BAND: {
					echo 'Table format is: ' . ARTIST_BAND . '<br />';
					break;
				}

				default:
				echo $tableFormat . ' is not a valid table format.<br />';
			}
			
		echo '<br>Total Results: ' . $result->num_rows;
		
		//Close DB object
		$db->close;
	}
		
		
	?>
	
	<form name="formDBF" 
		  action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" 
		  method="POST">
		  
		<strong>What information would you like to view?</strong>
		<!-- Javascript for submission -->
		<select name="listDisplay" onchange="this.form.submit()">
			<option value="null">Select an item</option>
			<option value="song">Song</option>
			<option value="band">Band</option>
			<option value="songAlbum">Songs on an Album</option>
			<option value="artistBand">Artist in Band</option>
		</select>
		
		<!-- Alternative button in case JavaScript not active -->
		<noscript>
			&nbsp; &nbsp; &nbsp; 
			<input type="submit" name="btnSubmit" value="View The list" />
		</noscript>
		<!-- Use a hidden field to tell server if return visitor -->
		<input type="hidden" name="hidIsReturning" value="true" />
	</form>
	<?php
		displayData();
	?>   
   
</div>
</body>
</html>
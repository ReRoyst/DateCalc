<?php

	require_once ("settings.php"); //connection info 
 	
	$conn = @mysqli_connect($host, 
			$user,
			$pwd,
			$sql_db,
			$port	
			);
			
	if (!$conn) { 
				echo "<p>Database connection failure</p>"; 
			} else {
				
			$query = "select * from V1"; 
			$result = mysqli_query($conn, $query); 
			if(!$result) { 
				echo "<p>Something is wrong with ", $query, "</p>";
			} else {
				while ($row = mysqli_fetch_assoc($result))
				{
					$name = $row["FirstName"];
					$dob = $row["DOB"];
					$dateadd = $row["DateAdded"];
					$daysalive = $row["DaysAlive"];
					$name = explode(' ', $name, 2);
					$martiandays = $daysalive * 0.9797;
					$query = "Insert into V2(Firstname, Surname, DOB, DateAdded, EarthDaysAlive, MartianDaysAlive) value ('$name[0]', '$name[1]', '$dob', '$dateadd', $daysalive, $martiandays)"; 
					mysqli_query($conn, $query);

					if(!$result) { 
					echo "<p>Something is wrong with ", $query, "</p>";	
					}
				}
			
		
			
				echo "<p>Added into Database</p>";
			}
			}	
			
			

?>

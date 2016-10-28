<!DOCTYPE HTML>

<html lang="en">

<head>
	<meta charset="utf-8"/> 
	<meta name="description" content="Assignment"/> 
	<meta name="keywords" content="PHP"/> 
	<meta name="author" content="Royston Bout"/> 
	<title>DateCalculator 1.0</title>
	
</head>

<Body>

<?php 
	//connect to database
	require_once ("settings.php"); 
 
	$conn = @mysqli_connect($host, 
	$user,
	$pwd,
	$sql_db,
	$port	
	);

 	if (!$conn) { 
		echo "<p>Database connection failure</p>"; 
	} else { 
	//check if it was succesful
		$query = "select * FROM V1"; 
		$result = mysqli_query($conn, $query); 
		if(!$result) { 
			echo "<p>Something is wrong with ", $query, "</p>";
		} else {
		
		
	//print the table
	echo "<table border=\"1\">"; 
	echo "<tr>" 
	."<th scope=\"col\">First Name</th>" 
	."<th scope=\"col\">Date of Birth</th>" 
	."<th scope=\"col\">DateAdded</th>"
	."<th scope=\"col\">DaysAlive</th>"
	."</tr>";

	//print all rows while there are some
	while ($row = mysqli_fetch_assoc($result)){ 
		echo "<tr>"; 
		echo "<td>",$row["FirstName"],"</td>"; 
		echo "<td>",$row["DOB"],"</td>"; 
		echo "<td>",$row["DateAdded"],"</td>";
		echo "<td>",$row["DaysAlive"],"</td>";
		echo "</tr>"; 
	}
	echo "</table>";
	
	mysqli_free_result($result); 
	} 
		mysqli_close($conn); 
} 
	?>

	<form method="post" action="DateCalc1.php">
		<p><label for="Name">FirstName</label></p>
			<input type="text" name="FirstName" id="FirstName" size="25" maxlength="25"  required = "required"/> 
			
		<p><label for="DateOfBirth">Date of Birth</label></p>
			<input type="date" name = "DateofBirth" id="DateOfBirth">
			
		<p id = dayage> </p>
		
		<input type="submit">
	</form>
	
		<?php
		use Carbon\Carbon;
			
			if (isset($_POST["FirstName"]))
			{
			 require 'libs/Carbon/Carbon.php';
			 require_once ("settings.php"); //connection info 
			
			$dob = '';
			@$firstname = $_POST["FirstName"];
			@$dob = date('y-m-d', strtotime($_POST["DateofBirth"]));
			$Cdateofbirth = Carbon::parse($dob);
			$current = Carbon::now();
			$daysalive = $Cdateofbirth->DiffInDays($current);
			echo "<p>You have been $daysalive</p>";
			$conn = @mysqli_connect($host, 
			$user,
			$pwd,
			$sql_db,
			$port	
			);
			
			
			
			if (!$conn) { 
				echo "<p>Database connection failure</p>"; 
			} else { 
			$query = "Insert into V1(FirstName, DOB, DateAdded, DaysAlive) values ('$firstname', '$Cdateofbirth', '$current', $daysalive)"; 
			$result = mysqli_query($conn, $query); 
			if(!$result) { 
				echo "<p>Something is wrong with ", $query, "</p>";
			} else {
				echo "<p>Added into Database</p>";
			}
			}	
			
			}
		?>
</body>
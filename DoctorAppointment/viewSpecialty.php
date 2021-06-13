<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "doctorappointmentsystem";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		// Check connection
		if (!$conn) {
			 die("Connection failed: " . mysqli_connect_error());
		}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Specialty</title>
		<style>
			header{
				padding:15px;
				margin:-8px;
				width:95%;
				height:50%;
				background-color:#f2f2f2;
			}
			h1{
				font-family:"Helvetica","Arial";
				font-size:25px;
				padding:2%;
				display:block;
				color:#262626;
			}
			nav{
				padding:18px;
				display:block;
				width:100%;
			}
			a:link{
				text-decoration:none;
				font-family:"Helvetica","Arial";
				color:#262626;
				background-color:#ffffff;
				padding:1% 2%;
				font-size:15px;
				margin:-1px;
			}
			a:visited{
				color:#000000;
			}
			a:hover{
				color:#000000;
				background-color:#e6e6e6;
			}
			#current{
				color:#e6e6e6;
				background-color:#262626;
			}
			main{
				padding:15px;
				font-family:"Helvetica","Arial";
			}
			h2{
				font-size:20px;
				padding:1%;
				display:block;
				color:#262626;
			}
			table{
				display:;
				margin:8px;
				width:60%;
			}
			table,th,td{
				border-bottom:1px solid;
				font-size:16px;
				border-collapse:collapse;
			}
			th,td{
				padding:1%;
			}
			th{
				color:#262626;
				background-color:#e6e6e6;
			}
			tr:hover{
				background-color:#f2f2f2;
			}
			#clearSearch{
				padding:1%;
			}
		</style>
	</head>

	<body>
		<header>
        	<h1>Doctor Appointment System</h1>
            <nav>
                <a href="index.php">Home</a>
                <a href="viewAppointment.php">Appointment</a>
                <a href="viewPatient.php">Patient</a>
                <a href="viewDoctor.php">Doctor</a>
                <a id="current" href="viewSpecialty.php">Specialty</a>
            </nav>
        </header>

        <main>
		<h2>Specialty List</h2>

		<?php
		$sql = "SELECT * FROM spec";
		$result = mysqli_query($conn,$sql)or die(mysqli_error());

		//print default table before search
		echo "<table id=\"defaulttable\"> 
				<tr>
					<th>Specialty ID</th><th>Specialty Name</th><th>Treatment Cost</th><th>Location</th><th>No. of Doctor</th>
				</tr>";

		while($row = mysqli_fetch_array($result)){
			echo "<tr><td>";
			echo $row['specID'];
			echo "</td><td>";
			echo $row['specDesc'];
			echo "</td><td>";
			echo $row['specTrmtCost'];
			echo "</td><td>";
			echo $row['specLoc'];
			echo "</td><td>";
			echo $row['docNum'];
			echo "</td></tr>";
		} 
		echo "</table>";
		?>
		</main>
	</body>
</html>
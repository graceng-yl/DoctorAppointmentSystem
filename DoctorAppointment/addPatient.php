<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "doctorappointmentsystem";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Patient</title>
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
				margin:2%;
				font-family:"Helvetica","Arial";
			}
			#back:link{
				text-decoration:none;
				font-family:"Helvetica","Arial";
				color:#ffffff;
				background-color:#404040;
				padding:1%;
				font-size:15px;
				border-radius:20px;
			}
			#back:visited{
				color:#ffffff;
			}
			#back:hover{
				color:#262626;
				background-color:#e6e6e6;
			}
			#form{
				padding:1%;
			}
			input{
				margin:3px;
			}
			.required{
				color:#ff0000;
			}
			#id{
				font-weight:bold;
			}
			#result{
				padding:1%;
				font-weight:bold;
			}
		</style>
	</head>

	<body>
		<header>
        	<h1>Doctor Appointment System</h1>
            <nav>
                <a href="index.php">Home</a>
                <a href="viewAppointment.php">Appointment</a>
                <a id="current" href="viewPatient.php">Patient</a>
                <a href="viewDoctor.php">Doctor</a>
                <a href="viewSpecialty.php">Specialty</a>
            </nav>
        </header>

        <main>
		<a id="back" href='viewPatient.php'>Back</a><br>

		<div id="form">
		<p class="required">* Required</p>

		<?php
		$patID = "P0001";
		$sql = "SELECT patID FROM patient ORDER BY patID DESC LIMIT 1";
		$result = mysqli_query($conn,$sql)or die(mysqli_error());
		$lastID = mysqli_fetch_array($result);

		$num = explode('P', $lastID['patID']);
		$num[1] = $num[1] + 1;
		$a = (string)$num[1];

		if(strlen($a)==1)
			$patID = 'P000'.$a;
		else if(strlen($a)==2)
			$patID = 'P00'.$a;
		else if(strlen($a)==3)
			$patID = 'P0'.$a;
		else if(strlen($a)==4)
			$patID = 'P'.$a;

		echo "<p id=\"id\">Patient ID: $patID</p>";
		?>

		<form method="post">
			<label class="required" for="patFname">*</label>
			<label for="patFname">First Name: </label>
			<input type="text" name="patFname" required><br>

			<label for="patLname">Last Name: </label>
			<input type="text" name="patLname"><br>

			<label class="required" for="patGender">*</label>
			<label for="patGender">Gender: </label>
			<input type="radio" id="male" name="patGender" value="M" required>
			<label for="male">M</label>
			<input type="radio" id="female" name="patGender" value="F" required>
			<label for="male">F</label><br>

			<label class="required" for="patContact">*</label>
			<label for="patContact">Contact: </label>
			<input type="text" name="patContact" required><br>

			<label for="patDOB">Date of birth: </label>
			<input type="date" name="patDOB"><br>

			<label for="patAddress">Address: </label>
			<input type="text" name="patAddress"><br>

			<input type="submit" value="submit">
		</form>
		
		<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			$patFname = $_POST['patFname'];
			$patLname = $_POST['patLname'];
			$patGender = $_POST['patGender'];
			$patContact = $_POST['patContact'];
			$patDOB = $_POST['patDOB'];
			$patAddress = $_POST['patAddress'];

			$sql = "INSERT INTO patient VALUES (?,?,?,?,?,?,?);";
			$stmt = mysqli_prepare($conn,$sql);
			$stmt->bind_param("sssssss", $patID, $_POST['patFname'], $_POST['patLname'], $_POST['patGender'], $_POST['patContact'], $_POST['patDOB'], $_POST['patAddress']);
			$stmt->execute();

			echo "<p id=\"result\">Patient added sucessfully</p>";
		}

		?>
	</body>
</html>
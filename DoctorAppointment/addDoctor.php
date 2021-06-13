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
		<title>Doctor</title>
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
                <a href="viewPatient.php">Patient</a>
                <a id="current" href="viewDoctor.php">Doctor</a>
                <a href="viewSpecialty.php">Specialty</a>
            </nav>
        </header>

        <main>
		<a id="back" href='viewDoctor.php'>Back</a><br>

		<div id="form">
		<p class="required">* Required</p>

		<?php
		$docID = "D001";
		$sql = "SELECT docID FROM doctor ORDER BY docID DESC LIMIT 1";
		$result = mysqli_query($conn,$sql)or die(mysqli_error());
		$lastID = mysqli_fetch_array($result);

		$num = explode('D', $lastID['docID']);
		$num[1] = $num[1] + 1;
		$a = (string)$num[1];

		if(strlen($a)==1)
			$docID = 'D00'.$a;
		else if(strlen($a)==2)
			$docID = 'D0'.$a;
		else if(strlen($a)==3)
			$docID = 'D'.$a;  

		echo "<p id=\"id\">Doctor ID: $docID</p>";  
		?>

		<form method="post">
			<label class="required" for="docFname">*</label>
			<label for="docFname">First Name: </label>
			<input type="text" name="docFname" required><br>

			<label for="docLname">Last Name: </label>
			<input type="text" name="docLname"><br>

			<label for="docContact">Contact: </label>
			<input type="text" name="docContact"><br>

			<label class="required" for="specDesc">*</label>
			<label for="specDesc">Specialty: </label>
			<select name="specDesc" required>
				<!-- <datalist id="descriptions"> -->
				<option value="Allergy & Immunology">Allergy & Immunology</option>
				<option value="Andrology">Andrology</option>
				<option value="Cardiology">Cardiology</option>
				<option value="Dentistry">Dentistry</option>
				<option value="Dermatology">Dermatology</option>
				<option value="Ear, Nose & Throat">Ear, Nose & Throat</option>
				<option value="Endocrinology">Endocrinology</option>
				<option value="Family Medicine">Family Medicine
				<option value="Gastroenterology">Gastroenterology</option>
				<option value="General Surgery">General Surgery</option>
				<option value="Geriatric">Geriatric</option>
				<option value="Hematology">Hematology</option>
				<option value="Nephrology">Nephrology</option>
				<option value="Neurology">Neurology</option>
				<option value="Nutrition & Dietic">Nutrition & Dietic</option>
				<option value="Oncology">Oncology</option>
				<option value="Pediatric">Pediatric</option>
				<option value="Physiotherapy">Physiotherapy</option>
				<option value="Psychiatry">Psychiatry</option>
				<option value="Urology">Urology</option>
				<!-- </datalist> --></select><br>

			<label class="required" for="roomID">*</label>
			<label for="roomID">Room ID: </label>
			<input type="text" name="roomID" required><br>
			
			<input type="submit" value="submit">
		</form>

		<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			$docFname = $_POST['docFname'];
			$docLname = $_POST['docLname'];
			$docContact = $_POST['docContact'];
			$specDesc = $_POST['specDesc'];
			$roomID = $_POST['roomID'];

			$sql = "SELECT specID FROM specialty WHERE specDesc='$specDesc'";
			$result = mysqli_query($conn,$sql)or die(mysqli_error());
			$specID = mysqli_fetch_array($result);

			$sql = "INSERT INTO doctor VALUES (?,?,?,?,?,?);";
			$stmt = mysqli_prepare($conn,$sql);
			$stmt->bind_param("ssssss", $docID, $_POST['docFname'], $_POST['docLname'], $_POST['docContact'], $specID[0], $_POST['roomID']);
			$stmt->execute();

			echo "<p id=\"result\">Doctor added sucessfully</p>";
		}
		?>
	</body>
</html>
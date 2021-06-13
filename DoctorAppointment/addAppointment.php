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
		<title>Appointment</title>
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
			#result{
				padding:1%;
				font-weight:bold;
			}
			#resulterr{
				padding:1%;
				color:#ff0000;
			}
		</style>
	</head>

	<body>
		<header>
        	<h1>Doctor Appointment System</h1>
            <nav>
                <a href="index.php">Home</a>
                <a id="current" href="viewAppointment.php">Appointment</a>
                <a href="viewPatient.php">Patient</a>
                <a href="viewDoctor.php">Doctor</a>
                <a href="viewSpecialty.php">Specialty</a>
            </nav>
        </header>

        <main>
		<a id="back" href='viewAppointment.php'>Back</a>

		<div id="form">
		<p class="required">* Required</p>
		<form method="post">
			<label class="required" for="apptDate">*</label>
			<label for="apptDate">Appointment Date: </label>
			<input type="date" id="datelim" name="apptDate" required><br>
			<script>
				var today = new Date();
				var dd = today.getDate();
				var mm = today.getMonth()+1; 
				var yyyy = today.getFullYear();
				if(dd<10){
					dd='0'+dd
				} 
				if(mm<10){
					mm='0'+mm
				} 
				today = yyyy+'-'+mm+'-'+dd;
				document.getElementById("datelim").setAttribute("min", today);
			</script>

			<label class="required" for="apptTime">*</label>
			<label for="apptTime">Appointment Time: </label>
			<select name="apptTime" required>
				<!-- <datalist id="times"> -->
				<option value="0900">0900</option>
				<option value="1000">1000</option>
				<option value="1100">1100</option>
				<option value="1300">1300</option>
				<option value="1400">1400</option>
				<option value="1500">1500</option>
				<option value="1600">1600</option>
				<option value="1700">1700</option>
				<!-- </datalist> --></select><br>

			<label class="required" for="docID">*</label>
			<label for="docID">Doctor ID: </label>
			<input type="text" name="docID" required><br>

			<label class="required" for="patID">*</label>
			<label for="patID">Patient ID: </label>
			<input type="text" name="patID" required><br>

			<input type="submit" value="submit">
		</form>
		</div>

		<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			$apptDate = $_POST['apptDate'];
			$apptTime = $_POST['apptTime'];
			$docID = $_POST['docID'];
			$patID = $_POST['patID'];

			$sql = "SELECT apptCheck('$apptDate','$apptTime','$docID')";
			$result = mysqli_query($conn,$sql)or die(mysqli_error());
			$availability = mysqli_fetch_array($result);

			if ($availability[0]=='Y'){
				$sql = "INSERT INTO appointment (apptDate,apptTime,docID,patID) VALUES (?,?,?,?);";
				$stmt = mysqli_prepare($conn,$sql);
				$stmt->bind_param("ssss", $_POST['apptDate'], $_POST['apptTime'], $_POST['docID'], $_POST['patID']);
				$stmt->execute();
				echo "<p id=\"result\">Appointment added sucessfully</p>";
			}
			else{
				echo "<p id=\"resulterr\">Time slot or doctor not available. Try another option.</p>";
			}
		}
		?>
		</main>
	</body>
</html>
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
		<title>Doctor Appointment System</title>
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
				width:100vw;
				padding:15px;
				font-family:"Helvetica","Arial";
			}
			#left{
				float:left;
				width:20%;
				padding:1%;
			}
			#right{
				float:right;
				width:70%;
			}
			h2{
				font-size:20px;
				padding:1%;
				color:#262626;
			}
			#add:link{
				text-decoration:none;
				color:#ffffff;
				background-color:#404040;
				padding:4%;
				font-size:15px;
				margin-left:2%;
				border-radius:20px;
			}
			#add:visited{
				color:#ffffff;
			}
			#add:hover{
				color:#262626;
				background-color:#e6e6e6;
			}
			ul{
				list-style-type: none;
				margin:0;
				padding-left:5px;
				line-height:300%;
			}
			#searchform, #result{
				padding:1%;
			}
			.result{
				padding:1%;
				font-weight:bold;
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
			#profit{
				margin-top:5%;
			}
		</style>
	</head>
	
	<body>
		<header>
        	<h1>Doctor Appointment System</h1>
            <nav>
                <a id="current" href="index.php">Home</a>
                <a href="viewAppointment.php">Appointment</a>
                <a href="viewPatient.php">Patient</a>
                <a href="viewDoctor.php">Doctor</a>
                <a href="viewSpecialty.php">Specialty</a>
            </nav>
        </header>
		
		<main>
			<section id="left">
				<div id="quick">
					<h2>Quick Actions</h2>
					<ul>
						<li><a id="add" href="addAppointment.php">Add Appointment</a></li>
						<li><a id="add" href="viewAppointment.php">View Appointment</a></li>
						<li><a id="add" href="addPatient.php">Add Patient</a></li>
					</ul>
				</div>
			</section>

			<section id="right">
				<div id="today">
					<h2>Today's Appointment</h2>
					
					<?php
					$apptDate = date("Y-m-d");
					echo "<p class=\"result\">$apptDate</p>";

					$sql = "SELECT apptID, apptTime, docName, patName FROM appt WHERE apptDate='$apptDate';";
            		$result = mysqli_query($conn,$sql)or die(mysqli_error());
            		
            		echo "<table> 
			                <tr>
			                    <th>Appointment ID</th>
			                    <th>Time</th>
			                    <th>Doctor</th>
			                    <th>Patient</th>
			                </tr>";

			        if (!empty($result)){
				        while($row = mysqli_fetch_array($result)){
				            echo "<tr><td>";
				            echo $row['apptID'];
				            echo "</td><td>";
				            echo $row['apptTime'];
				            echo "</td><td>";
				            echo $row['docName'];
				            echo "</td><td>";
				            echo $row['patName'];
				            echo "</td></tr>";
				        }
			    	}
			        echo "</table>";
					?>
				</div>

				<div id="profit">
					<h2>Total profit per day</h2>
		        	<form id="searchform" method="post">
		        		<label for="apptDate">Date: </label>
						<input type="date" name="apptDate" required>
						<input type="submit" value="submit">
					</form>

					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST"){
			            $apptDate = $_POST['apptDate'];

			            $sql = "SELECT totalProfitbyDay('$apptDate')";
	            		$result = mysqli_query($conn,$sql)or die(mysqli_error());
	            		$profit = mysqli_fetch_array($result);
	            		echo "<p class=\"result\">$apptDate: RM $profit[0]</p>";
            		}
		            ?>

				</div>


			</section>
		</main>
		
	</body>
</html>
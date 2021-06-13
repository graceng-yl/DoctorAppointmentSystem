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
				font-family:"Helvetica","Arial";
			}
			h2{
				font-size:20px;
				padding:1%;
				display:block;
				color:#262626;
			}
			#add:link{
				text-decoration:none;
				color:#ffffff;
				background-color:#404040;
				padding:1%;
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
			#search{
				padding:1%;
				margin-top:2%;
				margin-bottom:1%;
			}
			#searchtext{
				display:inline;
			}
			#searchform{
				display:inline;
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

        <script>
            function display_defaultTable(){
                document.getElementById("defaultTable").style.display = "";
                document.getElementById("clearSearch").style.display = "none";
                document.getElementById("searchTable").style.display = "none";
            }
            function display_searchTable(){
                document.getElementById("defaultTable").style.display = "none";
                document.getElementById("searchTable").style.display = "";
            }
        </script>
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
        <h2>Appointment List</h2>
        <a id="add" href='addAppointment.php'>Add Appointment</a><br>
        
        <div id="search">
        	<p id="searchtext">Search</p>
	        <form id="searchform" method="post">
	            <select name="attributes" required>
	                <!-- <datalist id="attributes"> -->
                    <option value="apptID">Appointment ID</option>
                    <option value="apptDate">Appointment Date</option>
                    <option value="apptTime">Appointment Time</option>
                    <option value="docName">Doctor Name</option>
                    <option value="patName">Patient Name</option>
	                <!-- </datalist> -->
	            </select>
	            <input type="text" name="search" required>
	            <input type="submit" value="submit">
	        </form>
    	</div>

        <?php
        $sql = "SELECT * FROM appt";
        $result = mysqli_query($conn,$sql)or die(mysqli_error());

        echo "<table id=\"defaultTable\"> 
                <tr>
                    <th>Appointment ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Doctor Name</th>
                    <th>Patient Name</th>
                </tr>";

        while($row = mysqli_fetch_array($result)){
            echo "<tr><td>";
            echo $row['apptID'];
            echo "</td><td>";
            echo $row['apptDate'];
            echo "</td><td>";
            echo $row['apptTime'];
            echo "</td><td>";
            echo $row['docName'];
            echo "</td><td>";
            echo $row['patName'];
            echo "</td></tr>";
        } 
        echo "</table>";

        //if enter something in search bar
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $type = $_POST['attributes'];
            $query = $_POST['search'];

            echo "<script>display_searchTable()</script>";
            echo "<p id=\"clearSearch\">Search by \"$type\" and value \"$query\" 
                <button onclick=display_defaultTable()>clear</button> 
                </p>";

            $sql = "SELECT * FROM appt WHERE $type LIKE '%$query%'";
            $result = mysqli_query($conn,$sql)or die(mysqli_error());

            //print table after search
            echo "<table id=\"searchTable\">
                <tr>
                    <th>Appointment ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Doctor Name</th>
                    <th>Patient Name</th>
            	</tr>";

            while($row = mysqli_fetch_array($result)){
                echo "<tr><td>";
                echo $row['apptID'];
                echo "</td><td>";
                echo $row['apptDate'];
                echo "</td><td>";
                echo $row['apptTime'];
                echo "</td><td>";
                echo $row['docName'];
                echo "</td><td>";
                echo $row['patName'];
                echo "</td></tr>";
            } 
            echo "</table>";
        }
        ?>
    	</main>
    </body>
</html>
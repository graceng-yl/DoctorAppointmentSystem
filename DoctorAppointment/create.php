<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql0 = "DROP DATABASE IF EXISTS doctorappointmentsystem";
mysqli_query($conn, $sql0);

// Create database
$sql1 = "CREATE DATABASE doctorappointmentsystem";
if (mysqli_query($conn, $sql1)) {
    echo "Database doctorappointmentsystem created successfully <br>";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

$conn = mysqli_connect($servername, $username, $password, "doctorappointmentsystem");

// sql to create table Patient
$sql2 = "create table if not exists patient(
    patID char(5) not null,
    patFname varchar(20) not null,
    patLname varchar(30),
    patGender enum('M', 'F') not null,
    patContact varchar(15) not null,
    patDOB date,
    patAddress varchar(50),
    primary key (patID)
);";

// sql to create table Specialty
$sql2 .= "create table if not exists specialty(
    specID char(3) not null,
    specDesc varchar(20),
    specTrmtCost decimal(5,2) not null,
    primary key (specID)
);";

// sql to create table Room
$sql2 .= "create table if not exists room(
	roomID char(4) not null,
	roomBlock char(1), 
	roomFloor char(1), 
	roomNo char(1),
	primary key (roomID)
);";

// sql to create table Doctor
$sql2 .= "create table if not exists doctor(
    docID char(4) not null,
    docFname varchar(20) not null,
    docLname varchar(30),
    docContact varchar(15),
    specID char(3) not null,
    roomID char(4) not null,
    primary key (docID),
    foreign key (specID) references specialty(specID) on delete cascade on update cascade,
    foreign key (roomID) references room(roomID) on delete cascade on update cascade
);";

// sql to create table Appointment
$sql2 .= "create table if not exists appointment(
    apptID integer auto_increment,
    apptDate date not null,
    apptTime enum('0900','1000','1100','1300','1400','1500','1600','1700') not null,
    apptFees decimal(4,2) not null default 50.00,
    docID char(4) not null,
    patID char(5) not null,
    primary key (apptID),
    foreign key (docID) references doctor(docID) on delete cascade on update cascade,
    foreign key (patID) references patient(patID) on delete cascade on update cascade
);";

if (mysqli_multi_query($conn, $sql2)) {
    echo "Tables created successfully ";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
mysqli_close($conn);

$conn = mysqli_connect($servername, $username, $password, "doctorappointmentsystem");
// sql to insert data into table Patient

// sql to insert data into table Speciatly
$sql3 = "insert into specialty values
('S01','Allergy & Immunology','150.00'),
('S02','Andrology','140.00'),
('S03','Cardiology','200.00'),
('S04','Dentistry','120.00'),
('S05','Dermatology','140.00'),
('S06','Ear, Nose & Throat','160.00'),
('S07','Endocrinology','150.00'),
('S08','Family Medicine','70.00'),
('S09','Gastroenterology','200.00'),
('S10','General Surgery','700.00'),
('S11','Geriatric','100.00'),
('S12','Hematology','200.00'),
('S13','Nephrology','200.00'),
('S14','Neurology','200.00'),
('S15','Nutrition & Dietic','150.00'),
('S16','Oncology','700.00'),
('S17','Pediatric','90.00'),
('S18','Physiotherapy','200.00'),
('S19','Psychiatry','200.00'),
('S20','Urology','190.00');";

// sql to insert data into table Room
$sql3 .= "insert into room values
('RA11','A','1','1'),
('RA12','A','1','2'),
('RA13','A','1','3'),
('RA14','A','1','4'),
('RA21','A','2','1'),
('RA22','A','2','2'),
('RA23','A','2','3'),
('RA24','A','2','4'),
('RA31','A','3','1'),
('RA32','A','3','2'),
('RA33','A','3','3'),
('RA34','A','3','4'),
('RA41','A','4','1'),
('RA42','A','4','2'),
('RA43','A','4','3'),
('RA44','A','4','4'),
('RB11','B','1','1'),
('RB12','B','1','2'),
('RB13','B','1','3'),
('RB14','B','1','4'),
('RB21','B','2','1'),
('RB22','B','2','2'),
('RB23','B','2','3'),
('RB24','B','2','4'),
('RB31','B','3','1'),
('RB32','B','3','2'),
('RB33','B','3','3'),
('RB34','B','3','4'),
('RB41','B','4','1'),
('RB42','B','4','2'),
('RB43','B','4','3'),
('RB44','B','4','4'),
('RC11','C','1','1'),
('RC12','C','1','2'),
('RC13','C','1','3'),
('RC14','C','1','4'),
('RC21','C','2','1'),
('RC22','C','2','2'),
('RC23','C','2','3'),
('RC24','C','2','4'),
('RC31','C','3','1'),
('RC32','C','3','2'),
('RC33','C','3','3'),
('RC34','C','3','4'),
('RC41','C','4','1'),
('RC42','C','4','2'),
('RC43','C','4','3'),
('RC44','C','4','4'),
('RD11','D','1','1'),
('RD12','D','1','2'),
('RD13','D','1','3'),
('RD14','D','1','4'),
('RD21','D','2','1'),
('RD22','D','2','2'),
('RD23','D','2','3'),
('RD24','D','2','4'),
('RD31','D','3','1'),
('RD32','D','3','2'),
('RD33','D','3','3'),
('RD34','D','3','4'),
('RD41','D','4','1'),
('RD42','D','4','2'),
('RD43','D','4','3'),
('RD44','D','4','4'),
('RE11','E','1','1'),
('RE12','E','1','2'),
('RE13','E','1','3'),
('RE14','E','1','4'),
('RE21','E','2','1'),
('RE22','E','2','2'),
('RE23','E','2','3'),
('RE24','E','2','4'),
('RE31','E','3','1'),
('RE32','E','3','2'),
('RE33','E','3','3'),
('RE34','E','3','4'),
('RE41','E','4','1'),
('RE42','E','4','2'),
('RE43','E','4','3'),
('RE44','E','4','4');";

if (mysqli_multi_query($conn, $sql3)) {
    echo "Data inserted successfully ";
} else {
    echo "Error insert data: " . mysqli_error($conn);
}

mysqli_close($conn);

$conn = mysqli_connect($servername, $username, $password, "doctorappointmentsystem");

$sql4 = "create view pat as
select patID, concat(patLname,' ',patFname) as patName, patGender, patContact, patDOB, patAddress 
from patient;";

$sql4 .= "create view appt as 
select apptID, apptDate, apptTime, concat(docLname, ' ', docFname) as docName, concat(patLname, ' ', patFname) as patName
from appointment a, doctor d, patient p
where a.docID=d.docID and a.patID=p.patID
order by apptID desc;";

$sql4 .= "create view doc as 
select docID, concat(docLname,' ',docFname) as docName, docContact, specDesc, roomID
from doctor d, specialty s
where d.specID=s.specID;";

$sql4 .= "create view spec as
select s.specID, specDesc, specTrmtCost, concat('Block ',roomBlock,' Floor ',roomFloor) as specLoc, count(docID) as docNum
from specialty s 
left join doctor d on s.specID=d.specID
left join room r on d.roomID=r.roomID
group by s.specID;";

if (mysqli_multi_query($conn, $sql4)) {
    echo "Views created successfully ";
} else {
    echo "Error creating views: " . mysqli_error($conn);
}

mysqli_close($conn);

$conn = mysqli_connect($servername, $username, $password, "doctorappointmentsystem");

$sql5 = "
create function totalProfitbyDay(inputDate Date)
returns decimal(6,2)
begin
    declare totalProfit decimal(6,2);
    select sum(apptFees) into totalProfit
    from appointment a
    where a.apptDate=inputDate;
    return totalProfit;
end;";
$result = mysqli_query($conn,$sql5)or die(mysqli_error());

$sql6 = "
create function apptCheck(inputDate date, inputTime char(4), inputDoc char(4))
returns char(1)
begin
    declare availability char(1);
    declare counter int;
    select count(apptID) into counter from appointment where apptDate=inputDate and apptTime=inputTime and docID=inputDoc;
    if counter!=0 then
        set availability = 'N';  
        return availability; 
    else 
        set availability = 'Y';
        return availability; 
    end if;
end;";
$result = mysqli_query($conn,$sql6)or die(mysqli_error());
?>
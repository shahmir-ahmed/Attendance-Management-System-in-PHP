<html>
    <head>
      <!-- Sweet Alert CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
    </head>
</html>

<?php

// Student will send his/her leave application form here

// Either student has marked the atendance already or sent leave...


// Starting session
session_start();

if(!isset($_SESSION['student'])){
    header('location: login.html');
}

// Taking login ID of the student
// $loginID = $_SESSION['login'];

// Taking student ID of the student
$studentID = $_GET['id'];

// fetching attendance & leave data for today

$dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

// Date in today format
$date = date("Y-m-d");

// because if there is no data for attendance in the DB for that student
$AttdatefromDB = NULL;

// because if there is no data for leave in the DB for that student
$AttdatefromDB = NULL;

// fetching the date of student's attendance from DB
$query1 = "SELECT attDate from tbl_attendance where stdID = $studentID ORDER BY attDate";

$result1 = mysqli_query($dbconn, $query1);

// fetching attendance data for today
while($result_data1 = mysqli_fetch_array($result1)){
    $AttdatefromDB = $result_data1[0];
}

// fetching the date of student's leave from DB
$query2 = "SELECT leaveDate from tbl_leaves where stdID = ".$studentID;

$result2 = mysqli_query($dbconn, $query2);

// fetching leave data for today
while($result_data2 = mysqli_fetch_array($result2)){
    $LeavedatefromDB = $result_data2[0];
}


// if there is no record of attendance in today's date or there is no record of students attendance and there is no record of leave in today's date or there is no record of leave for student
if(($AttdatefromDB != $date || $AttdatefromDB == NULL) && ($LeavedatefromDB != $date || $LeavedatefromDB == NULL)){

    header('location: leave.php?id='.$studentID.'');
}

// if there is record of today's attendance in DB
else if($AttdatefromDB == $date){
    echo "<script> 
        
    Swal.fire({
    icon : 'error',
    title: 'Sorry!',
    text: 'You cannot submit leave as you have already marked attendance for today!',
    confirmButtonText: 'OK',
    allowOutsideClick: false,
  }).then((result) => {
        if (result.isConfirmed) {
                window.location.replace('student.php?id=".$studentID."');
            }
          }) </script>";
}

// if there is record of today's leave in DB
else if($LeavedatefromDB == $date){
    echo "<script> 
        
    Swal.fire({
    icon : 'error',
    title: 'Sorry!',
    text: 'You have already submitted leave for today!',
    confirmButtonText: 'OK',
    allowOutsideClick: false,
  }).then((result) => {
        if (result.isConfirmed) {
                window.location.replace('student.php?id=".$studentID."');
            }
          }) </script>";
}


?>
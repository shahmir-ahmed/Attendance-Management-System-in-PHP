
<html>
    <head>
      <!-- Sweet Alert CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
    </head>
</html>

<?php

// check if session is set or not

session_start();

if(!isset($_SESSION['admin'])){
    header('location: login.html');
}

// Admin can delete the student's attenadance

$studentID = $_GET['id'];

$attDate = $_GET['date'];

// echo $studentID;

// echo $attDate;

$dbconn = mysqli_connect("localhost", "root", "", "attendance-system");

$query = "DELETE from tbl_attendance WHERE attDate = '".$attDate."' AND stdID = $studentID";

// echo $query;

$result = mysqli_query($dbconn, $query);

if($result){
    echo "<script> 
        
        Swal.fire({
        icon : 'success',
        title: 'Updated!',
        text: 'Attendance has been deleted successfully!',
        confirmButtonText: 'OK',
        allowOutsideClick: false,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.replace('student_attendance.php?id=".$studentID."');
        }
    }) </script>";

}
else{
    echo "<script> 
            
    Swal.fire({
    icon : 'error',
    title: 'Oops!',
    text: 'An error occured',
    confirmButtonText: 'OK',
    allowOutsideClick: false,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.replace('student_attendance.php?id=".$studentID."');
        }
    }) </script>";
}


?>
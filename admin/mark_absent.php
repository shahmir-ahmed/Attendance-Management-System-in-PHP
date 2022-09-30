
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

// Admin can mark/edit a student's attendance as absent 

$studentID = $_GET['id'];

$attDate = $_GET['date'];

$status = "Absent";

// echo $studentID;

// echo $attDate;

$dbconn = mysqli_connect("localhost", "root", "", "attendance-system");

$query = "UPDATE tbl_attendance SET attStatus = '".$status."' WHERE attDate = '".$attDate."' AND stdID = $studentID";

// echo $query;

$result = mysqli_query($dbconn, $query);

if($result){
    echo "<script> 
        
        Swal.fire({
        icon : 'success',
        title: 'Updated!',
        text: 'Attendance has been updated successfully!',
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
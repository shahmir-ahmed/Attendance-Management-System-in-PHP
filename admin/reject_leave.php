<html>
    <head>
        <!-- Sweet Alert CDN -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- CSS Stylesheet -->
        <link rel="stylesheet" href="../css/style.css">
    </head>
</html>
    
<?php

// In case of rejection the leave will be sent here

session_start();

if(!isset($_SESSION['admin'])){
    header('location: login.html');
}

$studentID = $_GET['id'];

$date = $_GET['date'];

$Lstatus = "Rejected";

$Astatus = "Absent";

// function approveLeave(){
//     echo 'Leave approved';
// }

// function rejectLeave(){
//     echo 'Leave rejected';
// }

// if(isset($_POST['approve'])){
//     approveLeave();
// }

// if(isset($_POST['reject'])){
//     rejectLeave();
// }

$dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

$query1 = "UPDATE tbl_leaves SET leaveStatus = '$Lstatus' WHERE stdID = $studentID";

// echo $query1;

$result1 = mysqli_query($dbconn, $query1);

// second query for updating the leave date attendance as present
$query2 = "INSERT INTO tbl_attendance(attDate, attStatus, stdID) VALUES('$date', '$Astatus', $studentID)";

$result2 = mysqli_query($dbconn, $query2);

// echo $query2;

if(($result1) && ($result2)){
    echo "<script> 
                
    Swal.fire({
    icon : 'success',
    title: 'Rejected!',
    text: 'Leave rejected and attendance marked successfully!',
    confirmButtonText: 'OK',
    allowOutsideClick: false,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.replace('pending_leaves.php');
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
            window.location.replace('students.php');
        }
    }) </script>";
}

?>
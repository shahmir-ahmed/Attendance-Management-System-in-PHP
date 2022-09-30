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

// Starting session
session_start();

if(!isset($_SESSION['student'])){
    header('location: login.html');
}

// Taking login ID of the student
// $loginID = $_SESSION['login'];

// Taking student ID of the student through URL
$studentID = $_GET['id'];

// sending leave of the student for today

$title = $_POST['title'];
$description = $_POST['description'];
$status = "Pending";

$dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

$query = "INSERT INTO tbl_leaves(leaveTitle, leaveDesc, leaveStatus, stdID) VALUES('".$title."', '".$description."', '".$status."', $studentID)";

// echo $query;

$result = mysqli_query($dbconn, $query);

// echo $result;

if($result){
    echo "<script> 
                
    Swal.fire({
    icon : 'success',
    title: 'Submitted!',
    text: 'Leave submitted successfully!',
    confirmButtonText: 'OK',
    allowOutsideClick: false,
}).then((result) => {
    if (result.isConfirmed) {
        window.location.replace('student.php?id=".$studentID."');
    }
}) </script>";
}


?>
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

/*error*/
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// take the student id and delete the student data from the database

$studentID = $_GET['id'];

// Connection to DB
$dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

// Query
$query = 'DELETE FROM tbl_students where stdID='.$studentID;

// echo $query;

// sending query to server
// $result = mysqli_query($dbconn, $query);

// redirection back to homepage

if($result){
    echo "<script> Swal.fire({
        icon : 'success',
        title: 'Success!',
        text: 'Student deleted succesfully',
        confirmButtonText: 'OK',
        allowOutsideClick: false,
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.replace('students.php');
        }
      }) </script>";
    // header('location: students.php');
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
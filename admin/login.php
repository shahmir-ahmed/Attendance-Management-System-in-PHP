<html>
    <head>
      <!-- Sweet Alert CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
    </head>
</html>

<?php

// Admin login authentication

/* error handling */
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// take values of admin
$username = $_POST['username'];
$password = $_POST['password'];

// to prevent sql injection
$username = stripcslashes($username);
$password = stripcslashes($password);

// build connection to db
$dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

// to prevent sql injection
$username = mysqli_real_escape_string($dbconn, $username);
$password = mysqli_real_escape_string($dbconn, $password);


// Send query to DB
// verify values
$query = 'SELECT * from tbl_admin_login';

// echo $query;

$result = mysqli_query($dbconn, $query) or die('Failed to query database.');

// variable for user data found intially set to false
$found = false;


// generate response
while($result_data = mysqli_fetch_array($result)){

    if($result_data[1] == $username && $result_data[2] == $password && strlen($result_data[2]) == strlen($password)){
        // Session Created

        session_start();

        $_SESSION['admin'] = $username;

        echo "<script> Swal.fire({
            icon : 'success',
            title: 'Success!',
            text: 'Welcome ".$result_data[1]."!  ^_^',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.replace('students.php');
            }
          }) </script>";
        $found = true;
    }
}

if($found == false){
    echo "<script> Swal.fire({
        icon : 'error',
        title: 'Oops!',
        text: 'Username or password is incorrect!',
        confirmButtonText: 'OK',
        allowOutsideClick: false,
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.replace('login.html');
        }
      }) </script>";

}


?>
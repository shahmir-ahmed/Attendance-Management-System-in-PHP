<html>
    <head>
    <!-- Sweet Alert CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
    </head>
</html>

<?php

// Student login authorization

/* error handling */
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// take student login and password
$username = $_POST['username'];
$password = $_POST['password'];

// to prevent sql injection
$username = stripcslashes($username);
$password = stripcslashes($password);

// build connection to db
$dbconn = mysqli_connect("localhost", "root", "", "attendance-system");

// to prevent sql injection
$username = mysqli_real_escape_string($dbconn, $username);
$password = mysqli_real_escape_string($dbconn, $password);

// Send query to DB
// verify values
// $query = 'SELECT * FROM tbl_student_login';

$query = "SELECT stdUsername, stdPassword, stdID from tbl_student_login WHERE stdUsername = '$username' AND stdPassword = '$password'";

// echo $query;

$result  = mysqli_query($dbconn, $query);

// var_dump($result); 

// variable found initially set to false
// $found = false;

// generate response

// fetch the user password and data

// issue of null

// if(!is_null($result_data1[0])){

// while($result_data1 = mysqli_fetch_array($result)){

    // if($result_data1[1] == $username && $result_data1[2] == $password && strlen($result_data1[2]) == strlen($password)){

      if(mysqli_num_rows($result)!=0){

        $result_data = mysqli_fetch_array($result);

      /* FETCHING THE STUDENT ID HERE RATHER THEN IN STUDENT.PHP */

      // using the login Id student used to login
      // $loginID = $result_data1[0];

      // $dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

      // // Now selecting the student ID using the login ID of student
      // $query2 = "SELECT stdId from tbl_student_login WHERE ID = ".$loginID;

      // $result2 = mysqli_query($dbconn, $query2);

      // // var_dump($result);

      // $result_data2 = mysqli_fetch_array($result2);

      // $studentId = $result_data2[0];

      // no need for above fetching of studentId beacuse index 4 of array is student id

      $studentId = $result_data[2];

      session_start();

      // CREATING SESSION OF STUDENT USERNAME RATHER THEN STUDENT LOGIN ID
      $_SESSION['student'] = $result_data[0];

        echo "<script> Swal.fire({
            icon : 'success',
            title: 'Success!',
            text: 'Welcome ".$username."!  ^_^',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.replace('student.php?id=".$studentId."');
            }
          }) </script>";

        // echo "<script> 
        // const Toast = Swal.mixin({
        //   toast: true,
        //   position: 'top',
        //   showConfirmButton: false,
        //   timer: 4000,
        //   timerProgressBar: true,
        // })
        
        // Toast.fire({
        //   icon: 'success',
        //   title: 'Signed in successfully'
        // }) 
        // </script>";

        // echo "<script> 
        // function goto(){
        //   window.location.replace('student.php?id=".$result_data[0]."');
        // }
        // setTimeout(goto(), 4000);
        // </script>";

        // $found = true;
    }
//  }


// if($found==false){
  else{
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
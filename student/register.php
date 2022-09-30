<html>
    <head>
      <!-- Sweet Alert CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
    </head>
</html>

<?php

// Student will register him.her self using the registration page

$name = $_POST['name'];
$fatherName = $_POST['fatherName'];
$class = $_POST['class'];
$rollNo = (int) $_POST['rollNo']; // converting the student rollNo to integer

$username = $_POST['username'];
$password = $_POST['password'];

// if(isset($_FILES['stdImage'])){

    $stdImage = $_FILES['stdImage'];
    // echo '<pre>';
    // print_r($_FILES);
    // echo '</pre>';

    // $file_name = $_FILES['stdImage']['name'];
    // $file_type = $_FILES['stdImage']['type'];
    $file_tmp_name = $_FILES['stdImage']['tmp_name'];

    // storing the image address into a variable
    $image = $file_tmp_name;

    // getting the content of the image from the address to store into DB
    $imgContent = addslashes(file_get_contents($image));

    // move_uploaded_file( $file_tmp_name, "D:/Xampp/htdocs/Eziline/Attendance Management System/upload-images/".$file_name);
// }

$dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

// to prevent sql injection
$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($dbconn, $username);
$password = mysqli_real_escape_string($dbconn, $password);

$query = "INSERT INTO tbl_students(stdRollno, stdName, stdFather, stdClass, stdImage) values ($rollNo, '".$name."', '".$fatherName."', 
 '".$class."', '".$imgContent."' )";

 // before when roll no was string
 // $query = 'INSERT INTO tbl_students(stdName, stdFather, stdClass, stdRollno) values ("'.$name.'","'.$fatherName.'", 
// "'.$rollNo.'","'.$class.'", )';

// echo $query;

 $result = mysqli_query($dbconn, $query);

// $query2 = "INSERT INTO tbl_student_login(stdUsername, stdPassword, stdID) VALUES ('".$username."', '".$password."' ,)"

// $query2 = 'SELECT LAST_INSERT_ID();';

//fetching the current ID inserted/created for student
$query2 = "SELECT MAX(stdID) from tbl_students";

$result2 = mysqli_query($dbconn, $query2);

// var_dump($result2);

while($resultData = mysqli_fetch_array($result2)){
     $studentID = $resultData[0];
}


// using the student ID fecthed as a foriegn key in student-login table
$query3 = "INSERT INTO tbl_student_login(stdUsername, stdPassword, stdID) VALUES ('".$username."', '".$password."' ,$studentID)";

$result3 = mysqli_query($dbconn, $query3);

if($result){
    
    echo "<script> Swal.fire({
            icon : 'success',
            title: 'Registred!',
            text: 'Log into your account using your username and password!',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
          }).then((result) => {
                if (result.isConfirmed) {
                        window.location.replace('login.html');
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
                  window.location.replace('register.html');
              }
          }) </script>";
                
            }

?>
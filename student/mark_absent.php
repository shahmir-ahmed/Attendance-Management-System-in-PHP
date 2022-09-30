<html>
    <head>
      <!-- Sweet Alert CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
    </head>
</html>

<?php

session_start();

if(!isset($_SESSION['student'])){
    header('location: login.html');
}

// because when the webpage refreshes the variable of the login Id in student.php is deleted so we have created a session for the loginID
// $loginID = $_SESSION['login'];

// Student will mark his/her attendance as present

$studentID = $_GET['id'];

$attendance = "Absent";

$dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

$date = date("Y-m-d");

// echo $date;

// var_dump($date);

$AttdatefromDB = NULL;

$LeavedatefromDB = NULL;

// fetching the date of student's attendance from DB
$query1 = "SELECT attDate from tbl_attendance where stdID = $studentID ORDER BY attDate";

// echo $query1;

$result1 = mysqli_query($dbconn, $query1);

// if($result1){
//     echo 'result recieved';
// }
// else{
//     echo 'no result';
// }

// var_dump($result1);

while($result_data1 = mysqli_fetch_array($result1)){
    // latest date will be fetched here
    $AttdatefromDB = $result_data1[0];
}

// var_dump($datefromDB);

//  if($datefromDB != $date){
//     echo 'Datefrom DB is not equal to today date';
//  }
//  else{
//     echo 'date matched';
//  }

// $allowed = false;

$query2 = "SELECT leaveDate from tbl_leaves where stdID = ".$studentID;

$result2 = mysqli_query($dbconn, $query2);

// fetching leave data for today
while($result_data2 = mysqli_fetch_array($result2)){
    $LeavedatefromDB = $result_data2[0];
}

// // if there is no record of attendance in today's date
// if($datefromDB != $date || $datefromDB == NULL){

// if there is no record of attendance in today's date or there is no record of students attendance and there is no record of leave in today's date or there is no record of leave for student
if(($AttdatefromDB != $date || $AttdatefromDB == NULL) && ($LeavedatefromDB != $date || $LeavedatefromDB == NULL)){

    $query3 = "INSERT into tbl_attendance(attStatus, stdID) VALUES('".$attendance."', $studentID)";

    
    
// echo $query2;

$result3 = mysqli_query($dbconn, $query3);

    if($result3){
        echo "<script> Swal.fire({
            icon : 'success',
            title: 'Attendance marked!',
            text: 'Today\'s attendance: Absent',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
        }).then((result) => {
                if (result.isConfirmed) {
                        window.location.replace('student.php?id=".$studentID."');
                    }
                }) </script>";
    }

}

// // if there is record of today's attendance in DB
// else{

// if there is record of today's attendance in DB
else if($AttdatefromDB == $date){
    echo "<script> 
        
    Swal.fire({
    icon : 'error',
    title: 'Sorry!',
    text: 'You have already marked attendance for today!',
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

        // echo "<script> Swal.fire({
        //     icon: 'question',
        //     title: 'Do you want to mark today\'s attendance as absent?',
        //     showDenyButton: true,
        //     confirmButtonText: 'Yes',
        //     denyButtonText: `No`,
        //     allowOutsideClick: false
        //   }).then((result) => {
        //     /* Read more about isConfirmed, isDenied below */
        //     if (result.isConfirmed) {
        //       '".$allowed = true."'
        //       Swal.fire({
        //         icon: 'success',
        //         title: 'Attendance Marked',
        //         confirmButtonText: 'OK',
        //         allowOutsideClick: false
        //       }).then((result) => {
        //         if (result.isConfirmed) {
        //                 window.location.replace('student.php?id=".$loginID."');
        //             }
        //       })
        //     } else if (result.isDenied) {
        //         Swal.fire({
        //             icon: 'info',
        //             title: 'Attendance not Marked!',
        //             confirmButtonText: 'OK',
        //             allowOutsideClick: false
        //           }).then((result) => {
        //             if (result.isConfirmed) {
        //                     window.location.replace('student.php?id=".$loginID."');
        //                 }
        //     })
        //   }
        // }) </script>";
        
        // if($allowed ==true){
        //     // $result2 = mysqli_query($dbconn, $query2);
        //     echo 'allowed';
        // }
        // else{
        //     echo 'not allowed';
        // }
?>
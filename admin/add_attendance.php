<html>
    <head>
        <!-- Favicon -->
        <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon"> 

        <!-- Sweet Alert CDN -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
</html>

<?php

// Admin can add a student's attendance from here

// check if session is set or not

session_start();

if(!isset($_SESSION['admin'])){
    header('location: login.html');
}


$dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

$query1 = "SELECT stdID, stdRollno, stdName from tbl_students";

$result1 = mysqli_query($dbconn, $query1);


if(isset($_POST['submit'])){

    $attDate = $_POST['date'];

    $studentID = $_POST['id'];

    $status = $_POST['status'];

    $query2 = "SELECT attDate from tbl_attendance WHERE attDate = '$attDate' AND stdID = $studentID";

    // echo $query2;

    $result2 = mysqli_query($dbconn, $query2);
    
    // var_dump($result2);

    // If the query returned no rows
    if (mysqli_num_rows($result2)==0){
        
        $query3 = "INSERT INTO tbl_attendance (attDate, attStatus, stdID) VALUES('$attDate', '$status', $studentID)";
        
        // echo $query3;
        
        // echo "Hello";

        $result3 = mysqli_query($dbconn, $query3);
        
        if($result3){
            echo "<script> 
            
            Swal.fire({
            icon : 'success',
            title: 'Added!',
            text: 'Attendance added successfully!',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace('add_attendance.php');
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
}

    else{
            echo "<script> 
                    
            Swal.fire({
            icon : 'error',
            title: 'Oops!',
            text: 'Attendance for this student has already been marked for the selected date!',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace('add_attendance.php');
                }
            }) </script>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student Attendance | Admin Panel | AMS</title>


        <!-- CSS Stylesheet -->
        <link rel="stylesheet" href="../css/style.css">

        <!-- Phone Stylesheet -->
        <link rel="stylesheet" href="../css/phone.css">

        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

        <a href="all_attendances.php" class="btn btn-secondary  go-back-btn"><i class="fa-solid fa-angle-left"></i> All Attendance</a>
        
        <div class="h1 text-center">Add Student Attendance</div>
    <hr>
    <form action="add_attendance.php" method="post">
    <div class="form-group">
        <div class="d-flex justify-content-around align-items-center flex-wrap">
            <div class="att-date">
                <div class="h4">Attendance Date:</div>
                <input type="date" name="date" required>
            </div>
            
            <div class="name">
                <div class="h4">Student Name:</div>
                <select name="id" required>
                    <option value="">Select Student</option>
                    <?php
                    while($result_data1 = mysqli_fetch_array($result1)){
                        // the value will be taken by the post method of the name given to this element
                    ?>
                    <option value="<?php echo $studentID =  $result_data1[0] ?>"><?php echo $result_data1[1]; echo "-"; echo $result_data1[2]; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="name">
                <div class="h4">Attendance:</div>
                <!-- the value will be taken by the post method of the name given to this element -->
                <select name="status" required>
                    <option value="">Select Attendance</option>
                    <option value="Present">Present</option>
                    <option value="Absent">Absent</option>
                </select>
            </div>
            
        </div>
        <br> <br> <br>
        <div class="submit text-center">
            <button onclick="return confirm('Add attendance?');" type="submit" name="submit" class="btn btn-success d-flex justify-content-center align-items-center" style="width: 50% !important">Add Attendance</button>
        </div>
    </div>
    </form>
</body>

        
        <!-- Bootstrap JS CDN -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
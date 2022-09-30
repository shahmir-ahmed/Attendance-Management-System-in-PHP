<!-- Favicon -->
<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon"> 
<?php

// Here admin will view all the attendances of students date wise and can add the attendance of any student through add_attendance webpage


// check if session is set or not

session_start();

if(!isset($_SESSION['admin'])){
    header('location: login.html');
}

// Admin will view All the student's attendance here

// Fetch the students attendance from DB

// $studentID = $_GET['id'];

$dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

// fetching the student data
// $query1 = "SELECT stdRollNo, stdName, stdClass from tbl_students where stdId=".$studentID;

// $result1 = mysqli_query($dbconn, $query1);


// fetching the student attendance data

$query2 = "SELECT s.stdRollno, s.stdName, s.stdClass, a.attDate, a.attStatus 
            from tbl_students s, tbl_attendance a 
            WHERE a.stdID = s.stdID 
            ORDER BY a.attDate";

$result2 = mysqli_query($dbconn, $query2);

?>

    
    
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance | Admin Panel | AMS</title>
        <!-- Favicon -->
        <!-- <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">  -->

        <!-- CSS Stylesheet -->
        <link rel="stylesheet" href="../css/style.css">

        <!-- Phone Stylesheet -->
        <link rel="stylesheet" href="../css/phone.css">

        <!-- Bootstrap Table CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.semanticui.min.css">

        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="header">
        <div class="left-btn">
            <a href="students.php" class="btn btn-secondary"><i class="fa-solid fa-angle-left"></i> Home</a>
        </div>
        
        <div class="h1 text-center">All Students Attendance</div>

        <div class="right-btn">
            <a style="margin: 10px" type="button" class="btn btn-success" href="add_attendance.php"><i class="fa-solid fa-user-plus"></i> Add Attendance</a>
        </div>
    </div>

    <!-- <hr/> -->
    <!-- Student Details -->
    <!-- <div class="d-flex justify-content-around align-items-center flex-wrap" style="margin: 10px;"> -->
    <?php 
    // while($result_data1 = mysqli_fetch_array($result1)){

    ?>

        <!-- <div class="h5 text-center"><b>RollNo:</b> <?php //echo $result_data1[0]; ?> </div> -->
        <!-- <div class="h5 text-center"><b>Name:</b> <?php //echo $result_data1[1]; ?> </div> -->
        <!-- <div class="h5 text-center"><b>Class:</b> <?php //echo $result_data1[2]; ?> </div> -->


    <?php
        // }
    ?>
    <!-- </div> -->
    <hr/>

    <!-- Student Attendance Details -->

    <div class="student-attendance-table">
        <table id="example" class="ui celled table" style="width:100%;">
            <thead>
                <tr>
                    <th>S#</th>
                    <th>Student RollNo.</th>
                    <th>Student Name</th>
                    <th>Student Class</th>
                    <th>Attendance Date</th>
                    <th>Attendance Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $serial = 1;
                while($result_data2 = mysqli_fetch_array($result2)){
                    
                ?>
                <tr>
                    <td><?php echo $serial ?></td>
                    <td><?php echo $rollNo = $result_data2[0] ?></td>
                    <td><?php echo $name = $result_data2[1] ?></td>
                    <td><?php echo $class = $result_data2[2] ?></td>
                    <td><?php echo $date = $result_data2[3] ?></td>
                    <?php $attendance = $result_data2[4] ?>

                    <?php
                        if($attendance == "Present"){

                            echo "<td style= color:green> ".$attendance." </td>";
                        }
                        else{
                            echo "<td style= color:red> ".$attendance." </td>";
                        }
                    ?>
                </tr>
                <?php

                 $serial++;
                }
                 ?>
            </tbody>
            </table>
        </div>
        <hr/>
    </body>

    <!-- Bootstrap JS CDN -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <!-- Bootstrap Fomantic UI Tables JS CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.js"></script>
    <script>
    $(document).ready(function () {
        $('#example').DataTable();
        });
        
        </script>
</html>
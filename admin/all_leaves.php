<?php

// Here admin will view all the leaves of students date wise either accepted, rejected or pending then can perform operation on pending leaves through pending_leaves webpage

// check if session is set or not

session_start();

if(!isset($_SESSION['admin'])){
    header('location: login.html');
}

// Fetch the students leaves from DB

$dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

// fetching the student data
// $query1 = "SELECT stdRollNo, stdName, stdClass from tbl_students";

// $result1 = mysqli_query($dbconn, $query1);

// fetching the student leave data

// $query2 = "SELECT leaveDate, leaveTitle, leaveDesc, leaveStatus from tbl_leaves WHERE leaveStatus = '".$status."'";
$query2 = "SELECT s.stdClass, s.stdName, l.leaveDate, l.leaveTitle, l.leaveDesc, l.leaveStatus
            FROM tbl_students s, tbl_leaves l
            WHERE s.stdID = l.stdID";

$result2 = mysqli_query($dbconn, $query2);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Leaves | Admin Panel | AMS</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon"> 

        <!-- CSS Stylesheet -->
        <link rel="stylesheet" href="../css/style.css">

        <!-- Phone Stylesheet -->
        <link rel="stylesheet" href="../css/phone.css">

        <!-- Bootstrap Table CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.semanticui.min.css">

        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

    <div class="header">
        <div class="left-btn">
            <a href="students.php" class="btn btn-dark"><i class="fa-solid fa-angle-left"></i> Home</a>
        </div>
        
        <div class="h1 text-center">All Leaves of Students</div>

        <div class="right-btn">
            <a  role="button" class="btn btn-warning" href="pending_leaves.php"><i class="fa-solid fa-clock"></i> Pending Leaves</a>
        </div>
    </div>
        

    <!-- <hr/> -->

    <!-- <div class="d-flex justify-content-around align-items-center flex-wrap" style="margin: 10px;"> -->
    <?php 
    // while($result_data1 = mysqli_fetch_array($result1)){

    ?>
<!-- 
        <div class="h5 text-center"><b>RollNo:</b> <?php //echo $result_data1[0]; ?> </div>
        <div class="h5 text-center"><b>Name:</b> <?php //echo $result_data1[1]; ?> </div>
        <div class="h5 text-center"><b>Class:</b> <?php //echo $result_data1[2]; ?> </div> -->


    <?php
        //}
    ?>
    <!-- </div> -->
    <hr/>


    <div class="student-leave-table">
        <table id="example" class="ui celled table" style="width:100%;">
            <thead>
                <tr>
                    <th>S#</th>
                    <th>Student Class</th>
                    <th>Student Name</th>
                    <th>Leave Date</th>
                    <th>Leave Title</th>
                    <th>Leave Description</th>
                    <th>Leave Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $serial = 1;
                while($result_data2 = mysqli_fetch_array($result2)){
                    
                ?>
                <tr>
                    <td><?php echo $serial ?></td>
                    <td><?php echo $class = $result_data2[0]; ?></td>
                    <td><?php echo $name = $result_data2[1]; ?></td>
                    <td><?php echo $date = $result_data2[2]; ?></td>
                    <td><?php echo $title = $result_data2[3]; ?></td>
                    <td><?php echo $desc = $result_data2[4]; ?></td>
                    <?php
                    $status = $result_data2[5];
                    if($status=='Approved'){
                        echo "<td style='color: green;'> $status </td>";
                    }
                    else if($status=='Rejected'){
                        echo "<td style='color: red;'> $status </td>";
                    }
                    else if($status=='Pending'){
                        echo "<td style='color: gold;'> $status </td>";
                    }
                    ?>
                </tr>
                <?php

                 $serial++;
                }
                 ?>
            </table>
        </div>
        <hr/>

        
        <!-- Bootstrap CDN -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <!-- Boostrap table JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.semanticui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.js"></script>

        <script>
            $(document).ready(function () {
            $('#example').DataTable();
            });
        </script>
    </body>
<?php

// Fetch the user's attendance from DB

$studentID = $_GET['id'];

$dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

// fetching the student data
$query1 = "SELECT stdRollNo, stdName, stdClass from tbl_students where stdId=".$studentID;

$result1 = mysqli_query($dbconn, $query1);


// fetching the student attendance data

$query2 = "SELECT attDate, attStatus from tbl_attendance WHERE stdID = $studentID ORDER BY attDate";

$result2 = mysqli_query($dbconn, $query2);

// fetching count of student's present and absents

$query3 = "SELECT COUNT(attStatus) as Presents
           FROM tbl_attendance
           WHERE stdID = $studentID
           AND attStatus = 'Present'";

$result3 = mysqli_query($dbconn, $query3);

// var_dump($result3);

$result_data3 = mysqli_fetch_array($result3);

$query4 = "SELECT COUNT(attStatus) as Absents
           FROM tbl_attendance
           WHERE stdID = $studentID
           AND attStatus = 'Absent'";

$result4 = mysqli_query($dbconn, $query4);

$result_data4 = mysqli_fetch_array($result4);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Attendance | AMS</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon"> 

        <!-- CSS Stylesheet -->
        <link rel="stylesheet" href="../css/style.css">

        <!-- Phone Stylesheet -->
        <link rel="stylesheet" href="../css/phone.css">

        
        <!-- Bootstrap Fomantic UI Tables CSS CDN  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.semanticui.min.css">
        
        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <!-- Header -->
    <div class="header">
        <div class="left-btn">
            <a href="student.php?id=<?php echo $studentID ?>" class="btn btn-outline-secondary"><i class="fa-solid fa-angle-left"></i> Home</a>
        </div>
        <div class="h1 text-center">All Previous Attendances</div>
        <div class="right-btn">
            <a href="view_leave.php?id=<?php echo $studentID ?>" class="btn btn-outline-info"><i class="fa-solid fa-envelope"></i> My Leaves</a>
        </div>
    </div>

    <!-- <div class="d-flex justify-content-between align-items-center" style="margin: 10px;">
        <a href="student.php?id=<?php echo $studentID ?>" class="btn btn-outline-secondary go-back-btn"><i class="fa-solid fa-angle-left"></i> Back</a>
        
        <div class="h1 text-center">All Previous Attendances</div>

        <a href="view_leave.php?id=<?php echo $studentID ?>" class="btn btn-outline-info go-back-btn"><i class="fa-solid fa-envelope"></i> My Leaves</a>
    </div> -->

    <hr/>
    
    <div class="d-flex justify-content-around align-items-center flex-wrap" style="margin: 10px;">
    <?php 
    while($result_data1 = mysqli_fetch_array($result1)){

    ?>

        <div class="h5 text-center"><b>RollNo:</b> <?php echo $result_data1[0]; ?> </div>
        <div class="h5 text-center"><b>Name:</b> <?php echo $result_data1[1]; ?> </div>
        <div class="h5 text-center"><b>Class:</b> <?php echo $result_data1[2]; ?> </div>


    <?php
        }
    ?>
    </div>
    <hr/>

    <div class="student-attendance-table">
        <div class="h4">Attendance Record: </div>
        <hr/>
        <div class="d-flex justify-content-between align-items-center flex-wrap w-50" style="margin: auto;">
            <div class="h6 text-center"><b>Total Presents:</b> <?php echo $result_data3["Presents"] ?></div>
            <div class="h6 text-center"><b>Total Absents:</b> <?php echo $result_data4["Absents"] ?></div>
        </div>
        <hr/>
        <table id="example" class="ui celled table" style="width:100%; margin:auto;">
            <thead>
                <tr>
                    <th>S#</th>
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
                    <td><?php echo $attDate = $result_data2[0] ?></td>
                    <?php  $attendance = $result_data2[1];
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

        
        <!-- Bootstrap CDN -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
        <!-- Bootstrap Fomantic UI Tables JS CDN -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.semanticui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.js"></script>
    </body>

    <script>
            $(document).ready(function () {
            $('#example').DataTable();
            });
    </script>
</html>
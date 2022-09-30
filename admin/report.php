<html>
    <head>
        <!-- Favicon -->
        <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon"> 

        <!-- Sweet Alert CDN -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
</html>

<?php

// Admin will be able to make report of a specific student from a selected date to a selected date

// check if session is set or not

session_start();

if(!isset($_SESSION['admin'])){
    header('location: login.html');
}

// Fetch the student's data, attendance and leave data from DB from start date to end date


$studentID = $_GET['id'];

$dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

// fetching the student data
$query1 = "SELECT stdRollNo, stdName, stdClass from tbl_students where stdId=".$studentID;

// echo $query1;
    
$result1 = mysqli_query($dbconn, $query1);


$result_data1 = mysqli_fetch_array($result1);

$rollNo = $result_data1[0];
$name = $result_data1[1];
$class = $result_data1[2];


if(isset($_POST['submit'])){

    // $studentName = $_GET['name'];
    
    $fromDate = $_POST['fromDate'];
    
    $toDate = $_POST['toDate'];
    
    // fetching the student attendance data
    
    $query2 = "SELECT attDate, attStatus from tbl_attendance WHERE stdID = $studentID AND attDate BETWEEN '$fromDate' AND '$toDate' ORDER BY attDate";

    // echo $query2;
    
    $result2 = mysqli_query($dbconn, $query2);

    // if the query returns rows for the selected dates
    if(mysqli_num_rows($result2)!=0){
        echo "<script> 
            
            Swal.fire({
            icon : 'success',
            title: 'Success!',
            text: 'Report Generated Successfully!',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
        }) </script>";
    
    }

    // if the query returns no rows for the selected dates
    else if(mysqli_num_rows($result2)==0){
        echo "<script> 
            
            Swal.fire({
            icon : 'info',
            title: 'Sorry!',
            text: 'No record found for the selected dates!',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
        }) </script>";
    }

    // in case if any of the both queries fail
    else if($result1==false || $result2==false){
        echo "<script> 
                
        Swal.fire({
        icon : 'error',
        title: 'Oops!',
        text: 'An error occured',
        confirmButtonText: 'OK',
        allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                // so that admin should not again instantly search but search after redirecting to home
                window.location.replace('students.php');
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
    <title>Student Report | Admin Panel | AMS</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon"> 

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

        <a href="students.php" class="btn btn-secondary  go-back-btn"><i class="fa-solid fa-angle-left"></i> Home</a>
        
        <div class="h1 text-center">Report Generation for <?php echo $name; ?></div>
    <hr>
    <form action="report.php?id=<?php echo $studentID ?>" method="post">
    <div class="form-group">
        <div class="d-flex justify-content-around align-items-center flex-wrap">
            <div class="from-date">
                <div class="h4">From:</div>
                <input type="date" name="fromDate" required>
            </div>
            
            <div class="to-date">
                <div class="h4">To:</div>
                <input type="date" name="toDate" required>
            </div>
            
        </div>
        <br> <br> <br>
        <div class="submit text-center">
            <button type="submit" name="submit" class="btn btn-success d-flex justify-content-center align-items-center" style="width: 50% !important">Generate Report</button>
        </div>
    </div>
    </form>
    
    <?php

        if(isset($_POST['submit'])){
    ?>
    <hr>
            <div class="h1 text-center">Student Attendance Report</div>
    <hr>

    <div class="d-flex justify-content-around align-items-center flex-wrap">
            <div class="from-date">
                <div class="h4">From: <?php echo $fromDate ?></div>
                
            </div>

            <div class="to-date">
                <div class="h4">To: <?php echo $toDate ?></div>
            </div>
    </div>

    <hr>

    <!-- Student Details with Report -->
    <div class="d-flex justify-content-around align-items-center flex-wrap" style="margin: 10px;">

        <div class="h5 text-center"><b>RollNo:</b> <?php echo $rollNo; ?> </div>
        <div class="h5 text-center"><b>Name:</b> <?php echo $name; ?> </div>
        <div class="h5 text-center"><b>Class:</b> <?php echo $class; ?> </div>

    </div>
    <hr/>

    <!-- Student Attendance Details -->

    <div class="student-attendance-table">
        <div class="h4">Attendance Record: </div>
        <hr/>
        <table id="example" class="ui celled table text-center" style="width:100%;">
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
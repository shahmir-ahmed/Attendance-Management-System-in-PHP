<?php

// Admin will view all the students with attendance here

/* error handling */
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// check if session is set or not

session_start();

if(!isset($_SESSION['admin'])){
    header('location: login.html');
}

// require_once('admin_login.html');

// make connection to database and bring all the student data from database

// connection
$dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

// Query
$query = 'SELECT * FROM tbl_students';

// sending query to server and recieving result
$result = mysqli_query($dbconn, $query) or die('error');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Admin Panel | AMS</title>

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
    
    <!-- Fonts Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <span>Logged in as <?php echo $_SESSION['admin'] ?></span>

    <div class="d-flex justify-content-between align-items-center header">
        <a style="margin: 10px" type="button" class="btn btn-danger" href="destroy_session.php"><i class="fa-solid fa-power-off"></i> Logout</a></button>

        <!-- <a style="margin: 10px" type="button" class="btn btn-success" href="add_attendance.php"><i class="fa-solid fa-user-plus"></i> Add Attendance</a> -->

        <!-- <a style="margin: 10px" type="button" class="btn btn-primary" href="all_attandances.php"><i class="fa-solid fa-clipboard"></i> Generate Report for a Student</a> -->
        
        <a style="margin: 10px" type="button" class="btn btn-info" href="all_attendances.php"><i class="fa-solid fa-clipboard"></i> All Attendances</a>

        
        <!-- <div class="h1">Student Details</div> -->

        <a style="margin: 10px" role="button" class="btn btn-dark" href="all_leaves.php"><i class="fa-solid fa-envelope"></i> All Leaves</a>
        <!-- <a style="margin: 10px" role="button" class="btn btn-dark" href="pending_leaves.php"><i class="fa-solid fa-clock"></i> Pending Leaves</a> -->

        <a style="margin: 10px" role="button" class="btn btn-primary" href="complete_report.php"><i class="fa-solid fa-file-lines"></i>  Generate System Report</a>
    </div>

    <div class="h1 text-center">Student Details</div>
    
    <!-- Using bootsrtap 4 tables -->
    <div class="students-table">
        <table id="example" class="ui celled table" style="width:100%">
            <thead>
                <tr>
                    <th>S#</th>
                    <th>Image</th>
                    <th>Roll No.</th>
                    <th>Student Name</th>
                    <th>Father Name</th>
                    <th>Class</th>
                    <th>Edit <br> Student</th>
                    <th>View <br> Record</th>
                    <th>Generate <br> Report</th>
                    <th>Delete <br> Student</th>
                </tr>
            </thead>
            <tbody>
                <?php

            $s = 1;

            while ($result_data = mysqli_fetch_array($result)) {
                
                ?>
       <tr>
            <td><?php echo $s; echo '.';?></td>

            <td>                
                <div class="user-image">
                    <!-- Displaying the image dynamically -->
                    <img src="data:image/png;charset=utf8;base64,<?php echo base64_encode($result_data[5]); ?>" width="80px" height="80px" id="student-image" alt="user-image"/>
                </div>
            </td>

            <td><?php echo $result_data[1]?></td>
            
            <td><?php echo $result_data[2]?></td>
            
            <td><?php echo $result_data[3]?></td>
            
            <td><?php echo $result_data[4]?></td>
            
            <td class="text-center">
            <a title="Edit" class="btn btn-secondary" href="edit_student.php?id=<?php echo $result_data[0]?>" role="button"><i class="fa-solid fa-user-pen fa-lg"></i></a>
            </td>
            <td  class="text-center">
            <a href="student_attendance.php?id=<?php echo $result_data[0] ?>" title="View Attendance" class="btn btn-info" role="button" ><i class="fa-solid fa-clipboard-user fa-lg"></i> + <i class="fa-solid fa-envelope"></i></a>
            </td>

            <td class="text-center">
                <a href="report.php?id=<?php echo $result_data[0] ?>" title="Report" class="btn btn-primary" role="button" ><i class="fa-solid fa-file-lines fa-lg"></i></a>

            <td class="text-center">
                <a onclick="return confirm('Are you sure you want to delete the student? (Note: it will erase all the data of student)')" href="delete_student.php?id=<?php echo $result_data[0] ?>" title="Remove" class="btn btn-danger" role="button" ><i class="fa-solid fa-trash fa-lg"></i></a>
            </td>

            </td>
            
        </tr>
            <?php

            $s++;

            }
            ?>
            
        </tbody>
    </table>
</div>
</body>

        <!-- Bootstrap CDN -->
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
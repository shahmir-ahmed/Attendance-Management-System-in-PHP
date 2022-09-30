<?php

session_start();

if(!isset($_SESSION['student'])){
    header('location: login.html');
}

// fetching the student data from DB

// // getting the login Id student used to login
// $loginID = $_GET['id'];

$dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

// // Now selecting the student ID using the login ID of student
// $query = "SELECT stdId from tbl_student_login WHERE ID = ".$loginID;

// $result = mysqli_query($dbconn, $query);

// // var_dump($result);

// while($result_data = mysqli_fetch_array($result)){
    //         $studentId = $result_data[0];
    // }
    
// getting the Student
$studentId = $_GET['id'];

// Now using the student ID fetched above to fetch student Image from the students table
$query2 = "SELECT stdImage from tbl_students where stdID = ".$studentId;

$result2 = mysqli_query($dbconn, $query2);

$result_data2 = mysqli_fetch_array($result2);

$studentImage = $result_data2[0];

// $day = date('l');

// if($day == "Saturday" || $day == "Sunday"){
//     echo "<marquee style ='
//     color: gold;
//     font-weight: bold;
//     font-size: 1.3rem;
//     position: absolute;'>";
//     echo "Enjoy! It is ".$day." today!";
//     echo "</marquee>";
// }
// else{
//     echo "<marquee>";
//     echo "Welcome ".$_SESSION['student']."!, its $day today!";
//     echo "</marquee>";
// }


// echo $studentImage;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Student Panel | AMS</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">

    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
    
    <!-- Phone Stylesheet -->
    <link rel="stylesheet" href="../css/phone.css">

    <!-- JavaScript -->
    <script src="../js/index.js"></script>
    
    <!-- Fonts Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Sweet Alert CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    
    <!-- Navigation Bar -->

    <header id="user-header">
        <div class="logo">
            <!-- <a href="destroy_session.php"> -->
                <img src="../images/logo.png" alt="logo" width="100%" height="100%">
            <!-- </a> -->
        </div>
        <div class="title" id="user-title">
            <h1> <span> Attendance</span> Management <span> System</span></h1>
        </div>
        <!-- <nav class="user-nav"> -->
        <nav>
            <ul class="nav-links column user-nav-links" id="nav-links">
                <div class="user-image">
                    <!-- Displaying the image dynamically -->
                    <img src="data:image/png;charset=utf8;base64,<?php echo base64_encode($studentImage); ?>" width="100%" height="100%" id="student-image" alt="user-image"/>
                </div>
                <li>
                    <a href="account.php?id=<?php echo $studentId ?>" class="my-account-btn"><i class="fa-solid fa-user"></i> My Account</a>
                </li>
                <!-- <li>
                    <a onclick="return confirm('Are you sure you want to logout?')" href="destroy_session.php" class="log-out"><i class="fa-solid fa-power-off"></i> Logout <?php echo $_SESSION['student']; ?></a>
                </li> -->
            </ul>
        </nav>
        <div class="hamburger">
            <button id="hamburger" onclick="show();">
                <img  style="filter: invert();" src="../images/hamburger.png" alt="" width="100%" height="100%">
            </button>
        </div>
                <!-- <div class="my-account-btn"> -->
                    <!-- <a href="account.php?id=">
                         's account ->
                    </a> -->
                <!-- </div> -->
            <!-- </ul> -->
        <!-- </nav> -->
    </header>

    <!-- Main Section -->

    <div class="attendance-buttons">
        <div class="present">
            <a onclick="return confirm('Are you sure you want to mark today\'s attendance as present?');" href="mark_present.php?id=<?php echo $studentId ?>" id="present">Mark Today's Attendance as Present</a>
        </div>
        <div class="absent">
            <a onclick="return confirm('Are you sure you want to mark today\'s attendance as absent?');" href="mark_absent.php?id=<?php echo $studentId ?>" id="absent">Mark Today's Attendance as Absent</a>
        </div>
        <div class="leave">
            <a href="check_for_leave.php?id=<?php echo $studentId ?>" id="leave">Send Leave for Today</a>
        </div>
        <div class="view">
            <a href="view_attendances.php?id=<?php echo $studentId ?>" id="view">View Past Attendance</a>
        </div>
    </div>

    <!-- Chat Online Section -->

    <!-- <div class="chat">
        <a href="#" title="Chat online with an admin">Chat<span>●</span></a>
    </div> -->

</body>

</html>
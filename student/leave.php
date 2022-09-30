<?php
session_start();

if(!isset($_SESSION['student'])){
    header('location: login.html');
}
// taking student ID through URL
$studentID = $_GET['id'];

// taking the session variable login

// $loginID = $_SESSION['login'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave For Today | Student</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">

    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="../css/phone.css">

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- Student will send leave reason from here to mark_leave.php -->

    <a href="student.php?id=<?php echo $studentID ?>" class="btn btn-outline-secondary go-back-btn"><i class="fa-solid fa-angle-left"></i> Back</a>

    <div class="h1 text-center">Leave Application</div> <br>

    <form action="mark_leave.php?id=<?php echo $studentID ?>" method="POST">
        <div class="form-group">
            <label for="title">Leave Title</label>
            <input type="text" name="title" class="form-control font-weight-bold" id="leave-title" placeholder="e.g. Leave application for Sick" required> <br>

            <label for="message">Leave Application</label>
            <textarea name="description" id="leave-message" placeholder="Type your leave message here..." class="form-control" rows="12" required></textarea>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" onclick="return confirm('Confirm submission?');">Submit Leave</button>
            </div>
            
        </div>
    </form>


    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>
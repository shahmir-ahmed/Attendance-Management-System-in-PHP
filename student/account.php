<html>
        <!-- Favicon -->
        <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">

        <!-- Sweet Alert 2 CDN -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>

<?php

session_start();

if(!isset($_SESSION['student'])){
    header('location: login.html');
}

// Here user will change the pic

// getting the Student ID
$studentId = $_GET['id'];

$dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

// Now using the student ID fetched above to fetch student Image from the students table
$query2 = "SELECT * from tbl_students where stdID = ".$studentId;

$result2 = mysqli_query($dbconn, $query2);

$result_data2 = mysqli_fetch_array($result2);

$studentRollNo = $result_data2[1];
$studentName = $result_data2[2];
$studentfatherName = $result_data2[3];
$studentClass = $result_data2[4];
$studentImage = $result_data2[5];


if(isset($_POST['submit'])){
    
    $studentRollNo = (int)$_POST['rollNo'];
    $studentName = $_POST['name'];
    $studentfatherName = $_POST['Fname'];
    $studentClass = $_POST['class'];
    // $studentImage = $_FILES['image'];
    

    // if user wants to change image
    if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])){

        $file_tmp_name = $_FILES['image']['tmp_name'];
    
        // storing the image address into a variable
        $image = $file_tmp_name;
    
        // getting the content of the image from the address to store into DB
        $imgContent = addslashes(file_get_contents($image));
    
        $query = "UPDATE tbl_students SET stdRollno = $studentRollNo, stdName = '".$studentName."', stdFather = '".$studentfatherName."', stdClass = '".$studentClass."', stdImage = '".$imgContent."' WHERE stdID = $studentId";
    
        // echo $query;
    
        $result = mysqli_query($dbconn, $query);

        // var_dump($result);
    }

    // if user does not want to change image
    else{
    
        $query = "UPDATE tbl_students SET stdRollno = $studentRollNo, stdName = '".$studentName."', stdFather = '".$studentfatherName."', stdClass = '".$studentClass."' WHERE stdID = ".$studentId;
    
        // echo $query;
    
        $result = mysqli_query($dbconn, $query) or die('error');
    }


    // echo $result;

    // header('location:student.php?id='.$studentId.'');

    if($result){
        echo "<script> 
                
        Swal.fire({
        icon : 'success',
        title: 'Updated!',
        text: 'Your details have been updated successfully',
        confirmButtonText: 'OK',
        allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.replace('student.php?id=".$studentId."');
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
                window.location.replace('student.php?id=".$studentId."');
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
    <title>My Account | AMS</title>

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

    <!-- Header -->
    <div class="header">
        <div class="left-btn">
            <a href="student.php?id=<?php echo $studentId ?>" class="btn btn-outline-secondary"><i class="fa-solid fa-angle-left"></i> Back</a>
        </div>
        <div class="h1 text-center">My Account</div>
        <div class="right-btn">
            <a onclick="return confirm('Are you sure you want to log out?')" href="destroy_session.php" class="btn btn-outline-danger"><i class="fa-solid fa-power-off"></i> Log out</a>
        </div>
    </div>

<!-- <div class="d-flex justify-content-between align-items-center" style="margin: 10px;">
        <a href="student.php?id=<?php echo $studentId ?>" class="btn btn-outline-secondary go-back-btn"><i class="fa-solid fa-angle-left"></i> Back</a>
        
        <div class="h1 text-center">My Account</div>

        <a onclick="return confirm('Are you sure you want to log out?')" href="destroy_session.php" class="btn btn-outline-danger go-back-btn"><i class="fa-solid fa-power-off"></i> Logout</a>
    </div> -->

    <form action="account.php?id=<?php echo $studentId ?>" method="POST" enctype="multipart/form-data">

        <div class="form-group text-bold">
            <label for="">Current Image: </label><br>

            <!-- Displaying the image dynamically -->
            <img src="data:image/png;charset=utf8;base64,<?php echo base64_encode($studentImage); ?>" width="145px" height="150px" id="student-image" alt="student-image"/> <br>

            <label for="">New Image:</label>
            <input type="file" name="image" class="form-control-file" id="">
            <span style="color: red;">(Image size must be less than 1mb)</span> <br> <br>

            <!-- <button type="submit" class="btn btn-success" style="width: 200px !important; margin: 20px 0 !important;">Update Image</button> <br> -->

            <label for="">Roll No:</label>
            <input class="form-control" type="text" placeholder="Your Roll No" name="rollNo" value="<?php echo $studentRollNo ?>" required><br>

            <label for="">Name:</label>
            <input class="form-control" type="text" placeholder="Your name" name="name" value="<?php echo $studentName ?>" required> <br>

            <label for="">Father Name:</label>
            <input class="form-control" type="text" placeholder="Your father name" name="Fname" value="<?php echo $studentfatherName ?>" required> <br>

            <label for="">Class: </label>
            <input class="form-control" type="text" placeholder="Your class" name="class" value="<?php echo $studentClass ?>" required>

            <button type="submit" name="submit" onclick="return confirm('Confirm changes?')" class="btn btn-success d-flex justify-content-center align-items-center">Update Changes</button>
            
        </div>
    </form>

    <!-- Boostrap CDN JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
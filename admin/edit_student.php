<html>
    <!-- Sweet Alert CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/icon">
</html>

<?php

// check if session is set or not

session_start();

if(!isset($_SESSION['admin'])){
    header('location: login.html');
}

/* error handling */
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// take id of the student and fetch that student data from the database and show the data below in html

$studentID = $_GET['id'];

// Connection to DB
$dbconn = mysqli_connect('localhost', 'root', '', 'attendance-system');

// Query
$query = 'SELECT * FROM tbl_students where stdID='.$studentID;

// sending query to server and recieving result
$result = mysqli_query($dbconn, $query) or die('error');

// recieve the data of the student with id
$result_data = mysqli_fetch_array($result);
    $rollNo = $result_data[1];
    $name = $result_data[2];
    $father = $result_data[3];
    $class = $result_data[4];
    $studentImage = $result_data[5];


// if the submit button is pressed
if(isset($_POST['submit'])){

    $rollNo = $_POST['rollNo'];
    $name = $_POST['name'];
    $father = $_POST['Fname'];
    $class = $_POST['class'];

    // if(isset($_FILES['image'])){

    //     var_dump($_FILES['image']);
    // }
    // else{
    //     echo "Image not set";
    // }


    // if admin wants to change image

    if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])){

        $file_tmp_name = $_FILES['image']['tmp_name'];
    
        // storing the image address into a variable
        $image = $file_tmp_name;
    
        // getting the content of the image from the address to store into DB
        $imgContent = addslashes(file_get_contents($image));
    
        $query = "UPDATE tbl_students SET stdRollNo = $rollNo, stdName = '$name', stdFather = '$father', stdClass = '$class', stdImage = '$imgContent' WHERE stdID= $studentID";
    
        // echo $query;
    
        $result = mysqli_query($dbconn, $query);

        // var_dump($result);
    }

    // if admin does not want to change image
    else{
    
        $query = "UPDATE tbl_students SET stdRollNo = $rollNo, stdName = '$name', stdFather = '$father', stdClass = '$class' WHERE stdID=".$studentID;
    
        // echo $query;
    
        $result = mysqli_query($dbconn, $query) or die('error');
    }


    if($result){
            echo "<script> 
                      
            Swal.fire({
            icon : 'success',
            title: 'Updated!',
            text: 'Student details updated!',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.replace('students.php');
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
    

    // header('location: students.php');

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Data</title>
        
        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- CSS Stylesheet -->
        <link rel="stylesheet" href="../css/style.css">

        <!-- CSS Stylesheet for Responsive Layout -->
        <link rel="stylesheet" href="../css/phone.css">

        <!-- Fonts Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

  <a href="students.php" class="btn btn-outline-secondary go-back-btn"><i class="fa-solid fa-angle-left"></i> Back</a>
  <div class="h1 text-center">Edit Student Details</div>


<!--  -->


<form action="edit_student.php?id=<?php echo $studentID ?>" method="POST" enctype="multipart/form-data">
  <div class="form-group">

  <label for="">Current Image: </label><br>

    <!-- Displaying the image dynamically -->
    <img src="data:image/png;charset=utf8;base64,<?php echo base64_encode($studentImage); ?>" width="145px" height="150px" id="student-image" alt="student-image"/> <br>

    <label for="">New Image:</label>
    <input type="file" name="image" class="form-control-file" id="">
    <span style="color: red;">(Image size must be less than 1mb)</span> <br> <br>

    <label for="">Roll No:</label>
    <input type="text" class="form-control" name="rollNo" value="<?php echo $rollNo ?>" required><br>
    
    <label for="">Name: </label>
    <input type="text" class="form-control" name="name" value="<?php echo $name ?>" required><br>

    <label for="">Father Name:</label>
    <input type="text" class="form-control" name="Fname" value="<?php echo $father ?>" required><br>
    
    <label for="">Class:</label>
    <input type="text" class="form-control" name="class" value="<?php echo $class ?>" required>
    
    <input onclick="return confirm('Confirm changes?')" type="submit" name="submit" class="btn btn-primary d-flex justify-content-center align-items-center" value="Edit Student">
    
  </div>
</form>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
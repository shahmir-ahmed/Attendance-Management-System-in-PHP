<?php

// check if session is set or not

session_start();

if(!isset($_SESSION['admin'])){
    header('location: login.html');
}

else{

    unset($_SESSION['admin']);
    
    session_destroy();
    
    // echo "here";
    
    header('location: login.html');
}

?>
<?php
session_start();
include('dbconnect.php'); // make sure this file exists in backend folder

if(isset($_POST['submit'])){ 

    $first_name = trim($_POST['firstname']);
    $last_name  = trim($_POST['lastname']);
    $email      = trim($_POST['mail']);
    $password   = trim($_POST['password']);

    if($first_name != "" && $last_name != "" && $email != "" && $password != ""){

        $sql = "INSERT INTO sign_up (first_name, last_name, email, password)
                VALUES ('$first_name', '$last_name', '$email', '$password')";

        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>alert('Signup Successful! Please Login.'); 
            window.location.href='../pages/login.php';</script>";
        } else {
            echo "<script>alert('Database Error!'); 
            window.location.href='../pages/signup.php';</script>";
        }

    } else {
        echo "<script>alert('Please fill all fields!'); 
        window.location.href='../pages/signup.php';</script>";
    }
}

?>

<?php
session_start();
include('dbconnect.php');

if(isset($_POST['submit'])){ 

    $email = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Fetch user from DB
    $sql_query = "SELECT * FROM sign_up WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql_query);

    if(mysqli_num_rows($result) > 0){

        $user = mysqli_fetch_assoc($result);

        // 🔥 IMPORTANT: Store user ID for feedback system
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['first_name'];
        $_SESSION['email'] = $user['email'];

        // Redirect to dashboard
        header("Location: ../pages/dashboard.php");
        exit();

    } else {
        echo "<script>alert('Invalid Email or Password');
        window.location.href='../pages/login.php';</script>";
    }
}
?>

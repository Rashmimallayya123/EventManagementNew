<?php
session_start();
include "../backend/dbconnect.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM admin_users WHERE admin_username='$username' AND admin_password='$password'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 1){
    $_SESSION["admin_logged_in"] = true;
    $_SESSION["admin_username"] = $username;
    header("Location: admin_dashboard.php");
} else {
    header("Location: admin_login.php?error=1");
}
?>

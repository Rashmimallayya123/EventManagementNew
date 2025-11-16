<?php
session_start();
include("dbconnect.php");

if (!isset($_POST["admin_login"])) {
    header("Location: admin_login.php");
    exit();
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$sql = "SELECT * FROM admin_users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {

    $admin = mysqli_fetch_assoc($result);

    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['admin_username'] = $admin['username'];

    header("Location: admin_dashboard.php");
    exit();

} else {
    header("Location: admin_login.php?error=1");
    exit();
}
?>

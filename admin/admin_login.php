<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial;
            background: #1c1c1c;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: #2e2e2e;
            padding: 25px;
            width: 320px;
            border-radius: 10px;
            box-shadow: 0 0 10px black;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: none;
        }
        button {
            background: #6a00ff;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background: #5200cc;
        }
    </style>
</head>

<body>

<div class="login-box">
    <h2>Admin Login</h2>
<?php
session_start();
include("dbconnect.php");

if (isset($_POST['admin_login'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM admin_users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {

        $admin = mysqli_fetch_assoc($result);

        // REQUIRED SESSION VALUES
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];

        header("Location: admin_dashboard.php");
        exit();

    } else {
        header("Location: admin_login.php?error=1");
        exit();
    }
}
?>

</body>
</html>




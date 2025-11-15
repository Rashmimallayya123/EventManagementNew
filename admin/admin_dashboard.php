<?php
session_start();

if(!isset($_SESSION["admin_logged_in"])){
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            background: #111;
            color: white;
            font-family: Arial;
            text-align: center;
            padding: 40px;
        }
        .card {
            background: #222;
            margin: 15px auto;
            padding: 20px;
            width: 300px;
            border-radius: 10px;
        }
        a {
            text-decoration: none;
            color: #f7d000;
            font-size: 20px;
        }
    </style>
</head>

<body>

<h1>Welcome Admin</h1>

<div class="card"><a href="manage_events.php" class="btn btn-warning btn-lg mb-3">Manage Events</a></div>
<div class="card"><a href="view_host_requests.php">Host Event Requests</a></div>
<div class="card"><a href="view_bookings.php">View Bookings</a></div>
<div class="card"><a href="view_feedback.php">View Feedback</a></div>
<div class="card"><a href="admin_logout.php">Logout</a></div>



</body>
</html>

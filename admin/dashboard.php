<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

include("../backend/dbconnect.php");

// Stats
$events = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM create_event"));
$approved = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM create_event WHERE status='approved'"));
$pending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM create_event WHERE status='pending'"));
$users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM sign_up"));
$bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM event_bookings"));
$requests = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM host_requests WHERE status='pending'"));
$feedback = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM feedback"));

// Notifications
$notifications = mysqli_query($conn, "SELECT * FROM notifications ORDER BY id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard | Event Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #0d0d0d;
            color: white;
            font-family: 'Poppins', sans-serif;
        }

        .card-box {
            background: rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 25px;
            height: 150px;
            transition: 0.3s;
            border: 1px solid rgba(255,255,255,0.15);
        }
        .card-box:hover {
            transform: translateY(-5px);
            background: rgba(255,255,255,0.12);
        }
        .stat-number {
            font-size: 32px;
            font-weight: 700;
        }
        .title-small {
            font-size: 14px;
            opacity: 0.8;
        }

        .noti-card {
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid rgba(255,255,255,0.15);
        }
    </style>
</head>

<body>

<div class="container mt-5">

    <h2 class="fw-bold text-warning">Admin Dashboard</h2>
    <p class="text-secondary mb-4">Welcome, <?php echo $_SESSION["admin_username"]; ?> 👋</p>

    <!-- STATS GRID -->
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card-box">
                <div class="stat-number text-warning"><?= $events['c'] ?></div>
                <div class="title-small">Total Events</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box">
                <div class="stat-number text-success"><?= $approved['c'] ?></div>
                <div class="title-small">Approved Events</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box">
                <div class="stat-number text-danger"><?= $pending['c'] ?></div>
                <div class="title-small">Pending Events</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box">
                <div class="stat-number text-info"><?= $users['c'] ?></div>
                <div class="title-small">Registered Users</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box">
                <div class="stat-number text-primary"><?= $bookings['c'] ?></div>
                <div class="title-small">Event Bookings</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box">
                <div class="stat-number text-warning"><?= $requests['c'] ?></div>
                <div class="title-small">Host Requests (Pending)</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box">
                <div class="stat-number text-light"><?= $feedback['c'] ?></div>
                <div class="title-small">Feedback Submitted</div>
            </div>
        </div>

    </div>

    <!-- Notifications -->
    <h4 class="mt-5 mb-3 text-warning">Recent Notifications</h4>

    <?php while ($row = mysqli_fetch_assoc($notifications)) { ?>
        <div class="noti-card">
            <b><?= $row['message'] ?></b>
            <div class="text-secondary small"><?= $row['created_at'] ?></div>
        </div>
    <?php } ?>

</div>

</body>
</html>

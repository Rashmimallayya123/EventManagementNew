<?php
session_start();
if(!isset($_SESSION['email'])) { header("Location: login.php"); exit(); }

include("../backend/dbconnect.php");

// Get event ID
if(!isset($_GET['id'])){
    echo "<script>alert('Invalid event!'); window.location.href='view_events.php';</script>";
    exit();
}

$event_id = $_GET['id'];
$event = mysqli_query($conn, "SELECT * FROM create_event WHERE event_id = '$event_id'");
$data = mysqli_fetch_assoc($event);

if(!$data){
    echo "<script>alert('Event not found!'); window.location.href='view_events.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?> | Event Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #050505;
            font-family: "Poppins", sans-serif;
            color: #fff;
        }

        .navbar-dark { background: rgba(0,0,0,0.9); }

        .event-banner {
            width: 100%;
            height: 320px;
            object-fit: cover;
            border-radius: 12px;
        }

        .detail-box {
            background: rgba(255,255,255,0.08);
            padding: 25px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.15);
            margin-top: -40px;
            position: relative;
        }

        .badge-status {
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 10px;
        }

        .btn-yellow {
            background: #ffd800;
            color: #000;
            font-weight: 600;
            border-radius: 12px;
            padding: 10px 22px;
            border: none;
        }

        .btn-yellow:hover { background: #e6c000; }

        .info-block {
            margin-bottom: 12px;
            font-size: 15px;
        }

        .info-block i {
            color: #ffd800;
            margin-right: 8px;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">

        <a class="navbar-brand fw-bold" href="dashboard.php">
            KLE (CSE) Productions
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="view_events.php">Events</a></li>
                <li class="nav-item ms-lg-3">
                    <span class="badge bg-warning text-dark"><i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?></span>
                </li>
                <li class="nav-item ms-lg-2">
                    <a href="../backend/logout.php" class="btn btn-outline-light btn-sm">
                        Logout
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>

<!-- EVENT DETAILS CONTENT -->
<div class="container" style="padding-top:100px;">

    <!-- Banner Image -->
    <img src="../assets/images/event_default.jpg" class="event-banner">

    <div class="detail-box">

        <!-- Event Title + Status -->
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold mb-0"><?php echo $data['title']; ?></h2>

            <span class="badge-status 
                <?php echo ($data['publish_event'] == 'yes') ? 'bg-success' : 'bg-secondary'; ?>">
                <?php echo ($data['publish_event'] == 'yes') ? 'Published' : 'Draft'; ?>
            </span>
        </div>

        <hr class="border-light">

        <!-- Event Info -->
        <div class="info-block">
            <i class="fa fa-calendar"></i> 
            <strong>Date:</strong> <?php echo $data['event_date']; ?>
        </div>

        <div class="info-block">
            <i class="fa fa-clock"></i> 
            <strong>Time:</strong> <?php echo $data['event_time']; ?>
        </div>

        <div class="info-block">
            <i class="fa fa-location-dot"></i> 
            <strong>Venue:</strong> <?php echo $data['venue']; ?>
        </div>

        <div class="info-block">
            <i class="fa fa-user-pen"></i> 
            <strong>Created By:</strong> <?php echo $data['created_by']; ?>
        </div>

        <hr class="border-light">

        <!-- Description -->
        <h5 class="fw-bold">About This Event</h5>
        <p style="line-height: 1.6;"><?php echo $data['description']; ?></p>

        <div class="d-flex justify-content-between mt-4">
            <a href="view_events.php" class="btn btn-outline-light">
                <i class="fa fa-arrow-left"></i> Back to Events
            </a>

            <a href="book_event.php?id=<?php echo $event_id; ?>" class="btn-yellow">
                <i class="fa fa-ticket"></i> Book Ticket
            </a>
        </div>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

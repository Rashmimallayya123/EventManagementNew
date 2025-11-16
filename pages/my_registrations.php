<?php
session_start();
if (!isset($_SESSION['email'])) { header("Location: login.php"); exit(); }

include("../backend/dbconnect.php");

$user_email = $_SESSION['email'];
$user_name  = $_SESSION['username'];

$bookings = mysqli_query($conn, 
    "SELECT * FROM event_bookings WHERE user_email='$user_email' ORDER BY booked_at DESC"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Registrations | KLE (CSE) Productions</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    body { background:#050505; color:white; font-family:Poppins; }
    .card-custom {
        background:rgba(255,255,255,0.08);
        padding:20px;
        border-radius:16px;
        border:1px solid rgba(255,255,255,0.12);
        margin-top:120px;
        backdrop-filter:blur(8px);
    }
    .booking-card {
        background:rgba(255,255,255,0.08);
        padding:20px;
        border-radius:15px;
        border:1px solid rgba(255,255,255,0.12);
        transition:0.3s;
    }
    .booking-card:hover {
        transform:scale(1.02);
        border-color:#ffd800;
    }
    .btn-yellow { background:#ffd800; color:black; font-weight:600; border-radius:8px; }
    .btn-yellow:hover { background:#e6c000; }
</style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background:rgba(0,0,0,0.9);">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">KLE (CSE) Productions</a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">

                <li><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li><a class="nav-link" href="view_events.php">Events</a></li>
                <li><a class="nav-link" href="book_event.php">Book Tickets</a></li>
                <li><a class="nav-link" href="gallery.php">Gallery</a></li>
                <li><a class="nav-link" href="feedback.php">Feedback</a></li>
                <li><a class="nav-link active" href="my_registrations.php">My Registrations</a></li>

                <li class="nav-item mx-2">
                    <span class="badge bg-warning text-dark">
                        <i class="fa fa-user"></i> <?php echo $user_name; ?>
                    </span>
                </li>

                <li><a href="../backend/logout.php" class="btn btn-outline-light btn-sm">Logout</a></li>

            </ul>
        </div>
    </div>
</nav>


<div class="container">

    <h3 class="fw-bold mb-4 mt-5">🎟 My Event Registrations</h3>

    <div class="row g-4">

        <?php if (mysqli_num_rows($bookings) == 0) { ?>

            <div class="col-12 text-center mt-4">
                <h5 class="text-warning">You have not booked any events yet.</h5>
            </div>

        <?php } ?>

        <?php while ($b = mysqli_fetch_assoc($bookings)) { ?>

            <div class="col-md-6">
                <div class="booking-card">

                    <h4 class="fw-bold"><?php echo $b['event_name']; ?></h4>

                    <p class="mt-2 mb-1"><b>Booking ID:</b> <?php echo $b['booking_id']; ?></p>
                    <p class="mb-1"><b>Name:</b> <?php echo $b['user_name']; ?></p>
                    <p class="mb-1"><b>Email:</b> <?php echo $b['user_email']; ?></p>
                    <p class="mb-1"><b>Booked At:</b> <?php echo $b['booked_at']; ?></p>

                    <a href="ticket.php?id=<?php echo $b['booking_id']; ?>" 
                       class="btn btn-yellow mt-3">
                       View Ticket
                    </a>

                </div>
            </div>

        <?php } ?>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

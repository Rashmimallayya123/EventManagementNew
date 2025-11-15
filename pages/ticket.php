<?php
session_start();
if (!isset($_SESSION['email'])) { 
    header("Location: login.php");
    exit();
}

include("../backend/dbconnect.php");

// Validate booking_id
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid Ticket Request!");
}

$booking_id = $_GET['id'];

// Fetch booking
$booking = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM event_bookings WHERE booking_id='$booking_id'")
);

if (!$booking) {
    die("Invalid Ticket! Booking not found.");
}

// Fetch event
$event = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM create_event WHERE event_id='{$booking['event_id']}'")
);

if (!$event) {
    die("Invalid Ticket! Event not found.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #050505;
            color: white;
            font-family: "Poppins", sans-serif;
        }

        .ticket-box {
            background: rgba(255,255,255,0.1);
            padding: 30px;
            border-radius: 20px;
            max-width: 520px;
            margin: 80px auto;
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 0 20px rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
        }

        .btn-yellow {
            background: #ffd800;
            color: black;
            font-weight: 600;
            border-radius: 8px;
        }

        .qr-box img {
            width: 200px;
            border-radius: 10px;
            padding: 10px;
            background: white;
        }
    </style>
</head>
<body>

<div class="ticket-box text-center">

    <h2 class="fw-bold">🎟 Your Event Ticket</h2>
    <hr class="border-light">

    <h4 class="fw-bold text-warning"><?php echo $booking['event_name']; ?></h4>

    <p><strong>Name:</strong> <?php echo $booking['user_name']; ?></p>
    <p><strong>Email:</strong> <?php echo $booking['user_email']; ?></p>

    <p><strong>Date:</strong> <?php echo $event['event_date']; ?></p>
    <p><strong>Time:</strong> <?php echo $event['event_time']; ?></p>
    <p><strong>Venue:</strong> <?php echo $event['venue']; ?></p>

    <p class="mt-3"><strong>Booking ID:</strong> #<?php echo $booking_id; ?></p>

    <div class="qr-box mt-3">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=BookingID-<?php echo $booking_id; ?>">
    </div>

    <hr class="border-light">

    <button onclick="window.print()" class="btn btn-yellow w-100 mt-2">
        Download Ticket (PDF)
    </button>

    <a href="dashboard.php" class="btn btn-outline-light w-100 mt-2">
        Back to Dashboard
    </a>

</div>

</body>
</html>

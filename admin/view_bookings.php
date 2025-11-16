<?php
session_start();

if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

include("../backend/dbconnect.php");

$bookings = mysqli_query($conn, "
    SELECT b.*, c.title 
    FROM event_bookings b
    LEFT JOIN create_event c ON b.event_id = c.event_id
    ORDER BY booking_id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - View Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">

    <h2 class="mb-4">Event Ticket Bookings</h2>

    <table class="table table-dark table-bordered">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Event</th>
                <th>Booked At</th>
            </tr>
        </thead>

        <tbody>
        <?php while ($row = mysqli_fetch_assoc($bookings)) { ?>
            <tr>
                <td><?= $row['booking_id'] ?></td>
                <td><?= $row['user_name'] ?></td>
                <td><?= $row['user_email'] ?></td>
                <td><?= $row['title'] ?? $row['event_name'] ?></td>
                <td><?= $row['booked_at'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

</body>
</html>

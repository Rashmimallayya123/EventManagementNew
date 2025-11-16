<?php
session_start();
include("dbconnect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['event_id'])) {
        die("Error: event_id not received!");
    }

    $event_id = $_POST['event_id'];
    $name = $_POST['user_name'];
    $email = $_POST['user_email'];

    // Fetch event details
    $event = mysqli_fetch_assoc(mysqli_query($conn,
        "SELECT * FROM create_event WHERE event_id='$event_id'"
    ));

    if (!$event) {
        die("Error: Event not found!");
    }

    // Insert booking
    $query = "INSERT INTO event_bookings (user_name, user_email, event_id, event_name)
              VALUES ('$name', '$email', '$event_id', '{$event['title']}')";

    mysqli_query($conn, $query);

    $booking_id = mysqli_insert_id($conn);

    // Redirect to ticket
    header("Location: ../pages/ticket.php?id=".$booking_id);
    exit();
}
?>

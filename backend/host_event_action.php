<?php
session_start();
include("dbconnect.php");

if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in.");
}

// User ID from session
$user_id = $_SESSION['user_id'];

// Get values from form
$title = $_POST['event_title'];
$description = $_POST['description'];
$date = $_POST['event_date'];
$time = $_POST['event_time'];
$venue = $_POST['venue'];

$status = "pending";
$publish_event = 0;

// Insert into DB (matching your DB structure)
$sql = "INSERT INTO create_event 
        (title, description, event_date, event_time, venue, publish_event, created_by) 
        VALUES 
        ('$title', '$description', '$date', '$time', '$venue', '$publish_event', '$user_id')";

if (mysqli_query($conn, $sql)) {
    header("Location: ../pages/host_event.php?success=1");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>

<?php
session_start();
include("dbconnect.php");

if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in.");
}

$user_id = $_SESSION['user_id'];

// Fetch POST data safely
$title = $_POST['event_title'] ?? '';
$description = $_POST['description'] ?? '';
$date = $_POST['event_date'] ?? '';
$time = $_POST['event_time'] ?? '';
$venue = $_POST['venue'] ?? '';

if ($title == '' || $date == '') {
    die("Error: Missing required fields.");
}

$status = "pending";
$publish_event = 0;

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

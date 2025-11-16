<?php
session_start();
include("dbconnect.php");

if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in.");
}

$user_id = $_SESSION['user_id'];

$title = $_POST['title'];
$description = $_POST['description'];
$date = $_POST['date'];
$venue = $_POST['venue'];

$status = "pending";
$publish_event = 0;

// Correct SQL based on your table structure
$sql = "INSERT INTO create_event (title, description, event_date, event_time, venue, publish_event, created_by)
        VALUES ('$title', '$description', '$date', '', '$venue', '$publish_event', '$user_id')";

if (mysqli_query($conn, $sql)) {
    header("Location: ../pages/host_event.php?success=1");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>

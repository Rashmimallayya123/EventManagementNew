<?php
session_start();
include("dbconnect.php");

// Check user session
if (!isset($_SESSION['user_id'])) {
    die("Error: user_id missing.");
}

$user_id = $_SESSION['user_id'];

// Check event_id
if (!isset($_POST['event_id'])) {
    die("Error: event_id missing.");
}

$event_id = $_POST['event_id'];
$message = $_POST['message'];

$query = "INSERT INTO feedback (user_id, event_id, message)
          VALUES ('$user_id', '$event_id', '$message')";

mysqli_query($conn, $query);

header("Location: ../pages/feedback.php?success=1");
exit();
?>

<?php
session_start();
include("dbconnect.php");

// Get user_id from session (must be set during login)
$user_id = $_SESSION['user_id']; 

// Get event_id from form
$event_id = $_POST['event_id'];

// Feedback message
$message = $_POST['message'];

// Prepare correct SQL
$query = "INSERT INTO feedback (user_id, event_id, message)
          VALUES ('$user_id', '$event_id', '$message')";

mysqli_query($conn, $query);

// Redirect back with success message
header("Location: ../pages/feedback.php?success=1");
exit();
?>

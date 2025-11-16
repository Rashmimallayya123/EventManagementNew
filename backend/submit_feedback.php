<?php
session_start();
include("dbconnect.php");

$name = $_POST['user_name'];
$email = $_POST['user_email'];
$event = $_POST['event_name'];
$rating = $_POST['rating'];
$message = $_POST['message'];

$query = "INSERT INTO feedback (user_name, user_email, event_name, rating, message)
          VALUES ('$name', '$email', '$event', '$rating', '$message')";

mysqli_query($conn, $query);

// Redirect back with success popup
header("Location: ../pages/feedback.php?success=1");
exit();
?>

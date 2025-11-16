<?php
session_start();
include("dbconnect.php");

// user_id must exist
if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in. user_id missing.");
}

$user_id = $_SESSION['user_id'];

// event_id must be posted from form
if (!isset($_POST['event_id'])) {
    die("Error: Event ID not received from form.");
}

$event_id = $_POST['event_id'];
$message = $_POST['message'];

// Insert into DB
$query = "INSERT INTO feedback (user_id, event_id, message)
          VALUES ('$user_id', '$event_id', '$message')";
mysqli_query($conn, $query);

header("Location: ../pages/feedback.php?success=1");
exit();
?>

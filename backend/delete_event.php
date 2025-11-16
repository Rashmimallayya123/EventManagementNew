<?php
session_start();
include("dbconnect.php");

if (!isset($_SESSION['email']) || $_SESSION['email'] !== "admin@gmail.com") {
    echo "Unauthorized!";
    exit();
}

$event_id = $_GET['id'];

// delete event
mysqli_query($conn, "DELETE FROM create_event WHERE event_id = $event_id");

// Redirect with success popup
header("Location: ../pages/view_events.php?success=event_deleted");
exit();
?>

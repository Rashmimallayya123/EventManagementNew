<?php
session_start();
include("../backend/dbconnect.php");

$event_id = $_POST['event_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$event_date = $_POST['event_date'];
$event_time = $_POST['event_time'];
$venue = $_POST['venue'];
$status = $_POST['status'];
$publish_event = $_POST['publish_event'];

$sql = "UPDATE create_event 
        SET title='$title', 
            description='$description', 
            event_date='$event_date', 
            event_time='$event_time', 
            venue='$venue',
            status='$status',
            publish_event='$publish_event'
        WHERE event_id=$event_id";

mysqli_query($conn, $sql);

// Add notification
mysqli_query($conn, "INSERT INTO notifications (message) 
VALUES ('Event ID $event_id updated by admin')");

header("Location: view_events.php");
exit();
?>

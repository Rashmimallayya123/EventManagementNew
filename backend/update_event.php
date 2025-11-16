<?php
session_start();
include("dbconnect.php");

$id    = $_POST['event_id'];
$title = $_POST['title'];
$desc  = $_POST['description'];
$date  = $_POST['event_date'];
$time  = $_POST['event_time'];
$venue = $_POST['venue'];
$pub   = $_POST['publish_event'];

$query = "UPDATE create_event SET 
            title='$title',
            description='$desc',
            event_date='$date',
            event_time='$time',
            venue='$venue',
            publish_event='$pub'
          WHERE event_id=$id";

mysqli_query($conn, $query);

// Success redirect
header("Location: ../pages/edit_event.php?id=$id&success=event_updated");
exit();
?>

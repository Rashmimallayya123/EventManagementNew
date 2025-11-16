<?php
session_start();
include("dbconnect.php");

if (!isset($_SESSION['email'])) {
    header("Location: ../frontend/login.php");
    exit();
}

if (isset($_POST['submit'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $venue = mysqli_real_escape_string($conn, $_POST['venue']);
    $publish_event = ($_POST['publish_event'] == "yes") ? 1 : 0;

    // email of event creator
    $created_by = $_SESSION['email'];

    $query = "INSERT INTO create_event (title, description, event_date, event_time, venue, publish_event, created_by)
              VALUES ('$title', '$description', '$event_date', '$event_time', '$venue', '$publish_event', '$created_by')";

    if (mysqli_query($conn, $query)) {
        // redirect with success message
       header("Location: ../pages/create_event.php?success=1");
exit();

    } else {
        echo "ERROR: " . mysqli_error($conn);
    }
}
?>

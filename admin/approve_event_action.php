<?php
session_start();
include("dbconnect.php");

if ($_SESSION['email'] !== "admin@gmail.com") {
    echo "Unauthorized!";
    exit();
}

$id = $_GET['id'];

mysqli_query($conn, 
    "UPDATE create_event SET publish_event='yes' WHERE event_id=$id"
);

// success popup
header("Location: ../admin/approve_events.php?success=approved");
exit();
?>

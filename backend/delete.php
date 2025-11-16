<?php
include("dbconnect.php");
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM create_event WHERE event_id = $id");
header("Location: ../pages/view_events.php");
?>

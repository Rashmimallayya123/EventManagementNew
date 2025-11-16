<?php
session_start();

if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

include("../backend/dbconnect.php");

if (!isset($_GET['id']) || !isset($_GET['action'])) {
    header("Location: manage_events.php?msg=Invalid+request");
    exit();
}

$event_id = (int) $_GET['id'];
$action   = $_GET['action'];
$msg      = "";

switch ($action) {

    case 'approve':
        $sql = "UPDATE create_event SET status='approved' WHERE event_id=$event_id";
        mysqli_query($conn, $sql);
        $msg = "Event #$event_id approved.";
        break;

    case 'reject':
        $sql = "UPDATE create_event SET status='rejected' WHERE event_id=$event_id";
        mysqli_query($conn, $sql);
        $msg = "Event #$event_id rejected.";
        break;

    case 'publish':
        // support 1/0
        $sql = "UPDATE create_event SET publish_event=1 WHERE event_id=$event_id";
        mysqli_query($conn, $sql);
        $msg = "Event #$event_id published.";
        break;

    case 'unpublish':
        $sql = "UPDATE create_event SET publish_event=0 WHERE event_id=$event_id";
        mysqli_query($conn, $sql);
        $msg = "Event #$event_id unpublished.";
        break;

    case 'delete':
        $sql = "DELETE FROM create_event WHERE event_id=$event_id";
        mysqli_query($conn, $sql);
        $msg = "Event #$event_id deleted.";
        break;

    default:
        $msg = "Unknown action.";
}

header("Location: manage_events.php?msg=" . urlencode($msg));
exit();

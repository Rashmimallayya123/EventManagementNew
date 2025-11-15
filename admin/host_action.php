<?php
include("../backend/dbconnect.php");

if (!isset($_GET['id']) || !isset($_GET['action'])) {
    die("<script>alert('Invalid request'); window.location='view_host_requests.php';</script>");
}

$id = intval($_GET['id']);
$action = $_GET['action'];

if ($action == "approve") {
    $sql = "UPDATE host_requests SET status='approved', publish_event=1 WHERE id=$id";
} elseif ($action == "reject") {
    $sql = "UPDATE host_requests SET status='rejected', publish_event=0 WHERE id=$id";
} else {
    die("<script>alert('Invalid action'); window.location='view_host_requests.php';</script>");
}

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Host request updated!'); window.location='view_host_requests.php';</script>";
} else {
    echo "ERROR: " . mysqli_error($conn);
}
?>

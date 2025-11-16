<?php
session_start();

if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

include("../backend/dbconnect.php");

$event_id = $_GET['id'];

$event = mysqli_query($conn, "SELECT * FROM create_event WHERE event_id=$event_id");
$data = mysqli_fetch_assoc($event);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">

    <h2 class="mb-4">Edit Event (ID: <?= $event_id ?>)</h2>

    <form action="update_event.php" method="POST">

        <input type="hidden" name="event_id" value="<?= $event_id ?>">

        <div class="mb-3">
            <label class="form-label">Event Title</label>
            <input type="text" name="title" value="<?= $data['title'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required><?= $data['description'] ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Event Date</label>
            <input type="date" name="event_date" value="<?= $data['event_date'] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Event Time</label>
            <input type="time" name="event_time" value="<?= $data['event_time'] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Venue</label>
            <input type="text" name="venue" value="<?= $data['venue'] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="pending" <?= $data['status']=='pending'?'selected':'' ?>>Pending</option>
                <option value="approved" <?= $data['status']=='approved'?'selected':'' ?>>Approved</option>
                <option value="rejected" <?= $data['status']=='rejected'?'selected':'' ?>>Rejected</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Publish Event</label>
            <select name="publish_event" class="form-control">
                <option value="1" <?= $data['publish_event']==1?'selected':'' ?>>Yes</option>
                <option value="0" <?= $data['publish_event']==0?'selected':'' ?>>No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Update Event</button>
        <a href="view_events.php" class="btn btn-secondary">Back</a>
    </form>

</div>

</body>
</html>

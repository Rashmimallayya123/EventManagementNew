<?php
session_start();

if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

include("../backend/dbconnect.php");

$events = mysqli_query($conn, "SELECT * FROM create_event ORDER BY event_date ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">
    <h2 class="mb-4">Manage Events</h2>

    <table class="table table-dark table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Published</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php while ($row = mysqli_fetch_assoc($events)) { ?>
            <tr>
                <td><?= $row['event_id'] ?></td>
                <td><?= $row['title'] ?></td>

                <td>
                    <?php if ($row['status'] == 'approved') { ?>
                        <span class="badge bg-success">Approved</span>
                    <?php } elseif ($row['status'] == 'rejected') { ?>
                        <span class="badge bg-danger">Rejected</span>
                    <?php } else { ?>
                        <span class="badge bg-warning">Pending</span>
                    <?php } ?>
                </td>

                <td>
                    <?php if ($row['publish_event'] == 1) { ?>
                        <span class="badge bg-primary">YES</span>
                    <?php } else { ?>
                        <span class="badge bg-secondary">NO</span>
                    <?php } ?>
                </td>

                <td>
                    <a href="event_action.php?id=<?= $row['event_id'] ?>&action=approve" class="btn btn-success btn-sm">Approve</a>
                    <a href="event_action.php?id=<?= $row['event_id'] ?>&action=reject" class="btn btn-danger btn-sm">Reject</a>
                    <a href="event_action.php?id=<?= $row['event_id'] ?>&action=publish" class="btn btn-primary btn-sm">Publish</a>
                    <a href="event_action.php?id=<?= $row['event_id'] ?>&action=unpublish" class="btn btn-secondary btn-sm">Unpublish</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

</body>
</html>

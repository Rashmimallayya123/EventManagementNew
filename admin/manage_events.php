<?php
session_start();

if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

include("../backend/dbconnect.php");

// Fetch all events
$events = mysqli_query($conn, "SELECT * FROM create_event ORDER BY event_id DESC");

// Optional message from actions
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background:#000; color:#fff; }
        .badge-pending { background:#ffc107; }
        .badge-approved { background:#28a745; }
        .badge-rejected { background:#dc3545; }
    </style>
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4 text-warning">Manage Events</h2>

    <?php if ($msg): ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($msg) ?>
        </div>
    <?php endif; ?>

    <table class="table table-dark table-bordered table-hover align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Date</th>
                <th>Time</th>
                <th>Venue</th>
                <th>Status</th>
                <th>Published?</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php while ($row = mysqli_fetch_assoc($events)) { ?>
            <tr>
                <td><?= $row['event_id'] ?></td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= $row['event_date'] ?></td>
                <td><?= $row['event_time'] ?></td>
                <td><?= htmlspecialchars($row['venue']) ?></td>

                <!-- STATUS BADGE -->
                <td>
                    <?php
                    $status = $row['status']; // pending / approved / rejected
                    if ($status == 'approved') {
                        echo '<span class="badge badge-approved">Approved</span>';
                    } elseif ($status == 'rejected') {
                        echo '<span class="badge badge-rejected">Rejected</span>';
                    } else {
                        echo '<span class="badge badge-pending">Pending</span>';
                    }
                    ?>
                </td>

                <!-- PUBLISH BADGE -->
                <td>
                    <?php
                    $pub = $row['publish_event'];
                    // handle 1/0 or yes/no
                    $isPublished = ($pub == 1 || $pub === 'yes');
                    echo $isPublished
                        ? '<span class="badge bg-success">Yes</span>'
                        : '<span class="badge bg-secondary">No</span>';
                    ?>
                </td>

                <!-- ACTION BUTTONS -->
                <td>
                    <!-- Approve / Reject -->
                    <a href="event_action.php?id=<?= $row['event_id'] ?>&action=approve"
                       class="btn btn-success btn-sm mb-1">Approve</a>

                    <a href="event_action.php?id=<?= $row['event_id'] ?>&action=reject"
                       class="btn btn-danger btn-sm mb-1">Reject</a>

                    <!-- Publish / Unpublish -->
                    <?php if (!$isPublished) { ?>
                        <a href="event_action.php?id=<?= $row['event_id'] ?>&action=publish"
                           class="btn btn-warning btn-sm mb-1">Publish</a>
                    <?php } else { ?>
                        <a href="event_action.php?id=<?= $row['event_id'] ?>&action=unpublish"
                           class="btn btn-outline-light btn-sm mb-1">Unpublish</a>
                    <?php } ?>

                    <!-- Delete -->
                    <a href="event_action.php?id=<?= $row['event_id'] ?>&action=delete"
                       class="btn btn-outline-danger btn-sm"
                       onclick="return confirm('Are you sure you want to DELETE this event?');">
                        Delete
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>

    </table>

    <a href="admin_dashboard.php" class="btn btn-outline-light mt-3">⬅ Back to Dashboard</a>
</div>

</body>
</html>

<?php
session_start();

if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

include("../backend/dbconnect.php");

// Fetch host requests (your column name is probably 'id' not 'request_id')
$requests = mysqli_query($conn, "SELECT * FROM host_requests ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Host Event Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">

    <h2 class="mb-4 text-warning">Host Event Requests</h2>

    <table class="table table-dark table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Requested By</th>
                <th>Event Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php while ($row = mysqli_fetch_assoc($requests)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['student_name'] ?></td>
                <td><?= $row['event_title'] ?></td>
                <td><?= $row['event_description'] ?></td>

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
                    <a href="host_action.php?id=<?= $row['id'] ?>&action=approve" 
                       class="btn btn-success btn-sm">Approve</a>

                    <a href="host_action.php?id=<?= $row['id'] ?>&action=reject" 
                       class="btn btn-danger btn-sm">Reject</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

</body>
</html>

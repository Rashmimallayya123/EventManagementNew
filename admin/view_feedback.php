<?php
session_start();

if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

include("../backend/dbconnect.php");

// Correct table columns
$feedback = mysqli_query($conn, "SELECT * FROM feedback ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - View Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">
    <h2 class="mb-4 text-warning">User Feedback</h2>

    <table class="table table-dark table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Event ID</th>
                <th>Message</th>
                <th>Created At</th>
            </tr>
        </thead>

        <tbody>
        <?php while ($row = mysqli_fetch_assoc($feedback)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['user_id'] ?></td>
                <td><?= $row['event_id'] ?></td>
                <td><?= $row['message'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
        <?php } ?>
        </tbody>

    </table>
</div>

</body>
</html>

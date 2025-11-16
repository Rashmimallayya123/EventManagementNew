<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

include("../backend/dbconnect.php");

$noti = mysqli_query($conn, "SELECT * FROM notifications ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="mb-4">Notifications</h2>

    <table class="table table-dark table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
        <?php while ($row = mysqli_fetch_assoc($noti)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['message'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>
</body>
</html>

<?php
session_start();
include("../backend/dbconnect.php");

if ($_SESSION['email'] !== "admin@gmail.com") {
    header("Location: ../pages/dashboard.php");
    exit();
}

$pending = mysqli_query($conn, "SELECT * FROM create_event WHERE publish_event='no'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Approve Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#050505; color:white; font-family:Poppins; }
        .card-box {
            background:rgba(255,255,255,0.08);
            padding:20px;
            border-radius:16px;
            border:1px solid rgba(255,255,255,0.2);
        }
    </style>
</head>

<body>

<div class="container" style="padding-top:120px;">
    <h2 class="fw-bold mb-4">🟡 Pending Events (Need Approval)</h2>

    <div class="row g-4">

        <?php while ($e = mysqli_fetch_assoc($pending)) { ?>

        <div class="col-md-4">
            <div class="card-box">

                <h5 class="fw-bold"><?php echo $e['title']; ?></h5>
                <p class="small mt-2"><?php echo $e['description']; ?></p>

                <a href="../backend/approve_event_action.php?id=<?php echo $e['event_id']; ?>"
                   class="btn btn-success btn-sm mt-2">Approve</a>

                <a href="../backend/delete_event.php?id=<?php echo $e['event_id']; ?>"
                   class="btn btn-danger btn-sm mt-2 ms-2"
                   onclick="return confirm('Delete this event?');">Delete</a>

            </div>
        </div>

        <?php } ?>

    </div>
</div>
<?php if (isset($_GET['success']) && $_GET['success']=="approved") { ?>
<script>
alert("Event approved successfully!");
</script>
<?php } ?>

</body>
</html>

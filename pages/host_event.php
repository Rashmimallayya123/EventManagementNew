<?php
session_start();
if (!isset($_SESSION['email'])) { header("Location: login.php"); exit(); }

include("../backend/dbconnect.php");

$user_name = $_SESSION['username'];
$user_email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Host Event | KLE (CSE) Productions</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body { background:#050505; color:white; font-family:Poppins; }
        .card-custom {
            background:rgba(255,255,255,0.08);
            padding:30px;
            border-radius:16px;
            border:1px solid rgba(255,255,255,0.12);
            margin-top:120px;
            backdrop-filter:blur(8px);
        }
        .btn-yellow { background:#ffd800; border-radius:10px; font-weight:600; color:black; }
        .btn-yellow:hover { background:#e6c000; }
        .form-control {
            background:rgba(255,255,255,0.1);
            border:1px solid rgba(255,255,255,0.3);
            color:white;
            border-radius:10px;
        }
    </style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background:rgba(0,0,0,0.9);">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">KLE (CSE) Productions</a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li><a class="nav-link" href="view_events.php">Events</a></li>
                <li><a class="nav-link" href="book_event.php">Book Tickets</a></li>
                <li><a class="nav-link" href="gallery.php">Gallery</a></li>
                <li><a class="nav-link" href="feedback.php">Feedback</a></li>
                <li><a class="nav-link active" href="host_event.php">Host Event</a></li>

                <li class="nav-item mx-2">
                    <span class="badge bg-warning text-dark"><i class="fa fa-user"></i> <?php echo $user_name; ?></span>
                </li>

                <li><a href="../backend/logout.php" class="btn btn-outline-light btn-sm">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container col-md-6">
    <div class="card-custom">

        <h3 class="fw-bold mb-3">Request to Host an Event</h3>
        <p class="text-warning">Fill this form to request approval to host a college event.</p>

        <form action="../backend/host_event_action.php" method="POST">

            <label class="mt-2">Your Name</label>
            <input type="text" name="user_name" class="form-control" value="<?php echo $user_name; ?>" readonly>

            <label class="mt-3">Email</label>
            <input type="email" name="user_email" class="form-control" value="<?php echo $user_email; ?>" readonly>

            <label class="mt-3">Event Title</label>
            <input type="text" name="event_title" class="form-control" placeholder="Enter event title" required>

            <label class="mt-3">Event Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Enter event details..." required></textarea>

            <label class="mt-3">Event Date</label>
            <input type="date" name="event_date" class="form-control" required>

            <label class="mt-3">Event Time</label>
            <input type="time" name="event_time" class="form-control" required>

            <label class="mt-3">Venue</label>
            <input type="text" name="venue" class="form-control" placeholder="Eg: Seminar Hall 1" required>
<button type="submit" name="submit" class="btn btn-yellow w-100 mt-4">
    Submit Request
</button>

        </form>

    </div>
</div>

<?php if (isset($_GET['success']) && $_GET['success']=="request_sent") { ?>
<script>
document.addEventListener("DOMContentLoaded", () => {
    showSuccess("Your request has been submitted!");
});
</script>
<?php } ?>

<!-- Global success popup -->
<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:#121212; color:white; border-radius:15px;">
      <div class="modal-header" style="border:none;">
        <h5 class="modal-title text-warning fw-bold">✔ Success</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center" id="successMessage"></div>
      <div class="modal-footer" style="border:none;">
        <button class="btn btn-warning fw-bold px-4" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<script>
function showSuccess(msg){
    document.getElementById("successMessage").innerHTML = msg;
    var myModal = new bootstrap.Modal(document.getElementById('successModal'));
    myModal.show();
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php if (isset($_GET['success']) && $_GET['success']=="request_submitted") { ?>
<script>
document.addEventListener("DOMContentLoaded", () => {
    showSuccess("Your event hosting request has been submitted!");
});
</script>
<?php } ?>
</body>
</html>


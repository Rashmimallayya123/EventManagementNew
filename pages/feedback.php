<?php
session_start();
if (!isset($_SESSION['email'])) { header("Location: login.php"); exit(); }

include("../backend/dbconnect.php");

$user_name = $_SESSION['username'];
$user_email = $_SESSION['email'];

// Get events for dropdown
$events = mysqli_query($conn, "SELECT title FROM create_event ORDER BY title ASC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Feedback | KLE (CSE) Productions</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body { background: #050505; color: white; font-family: "Poppins"; }
        .card-custom {
            background: rgba(255,255,255,0.08);
            padding: 30px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.12);
            backdrop-filter: blur(8px);
            margin-top: 120px;
        }
        .btn-yellow { background: #ffd800; border-radius: 10px; font-weight: 600; color: black; }
        .btn-yellow:hover { background: #e6c000; }
        .form-control { border-radius: 12px; background: rgba(255,255,255,0.1); color: white; }
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
                <li><a class="nav-link active" href="feedback.php">Feedback</a></li>

                <li class="nav-item mx-2">
                    <span class="badge bg-warning text-dark"><i class="fa fa-user"></i> <?php echo $user_name; ?></span>
                </li>
                <li class="nav-item">
                    <a href="../backend/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container col-md-6">
    <div class="card-custom">

        <h3 class="fw-bold mb-3">Submit Your Feedback</h3>
        <p class="text-warning">Your feedback helps us improve future events!</p>

        <form action="../backend/submit_feedback.php" method="POST">

            <label class="mt-2">Your Name</label>
            <input type="text" name="user_name" value="<?php echo $user_name; ?>" class="form-control" readonly>

            <label class="mt-3">Your Email</label>
            <input type="email" name="user_email" value="<?php echo $user_email; ?>" class="form-control" readonly>

            <label class="mt-3">Select Event</label>
            <select name="event_name" class="form-control" required>
                <option value="" disabled selected>Select Event</option>
                <?php while ($e = mysqli_fetch_assoc($events)) { ?>
                    <option value="<?php echo $e['title']; ?>"><?php echo $e['title']; ?></option>
                <?php } ?>
            </select>

            <label class="mt-3">Rating</label>
            <select name="rating" class="form-control" required>
                <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                <option value="4">⭐⭐⭐⭐ Good</option>
                <option value="3">⭐⭐⭐ Average</option>
                <option value="2">⭐⭐ Poor</option>
                <option value="1">⭐ Very Poor</option>
            </select>

            <label class="mt-3">Feedback Message</label>
            <textarea name="message" class="form-control" rows="4" placeholder="Write your feedback..." required></textarea>

            <button class="btn btn-yellow w-100 mt-4">Submit Feedback</button>
        </form>

    </div>
</div>
<?php if (isset($_GET['success'])) { ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var myModal = new bootstrap.Modal(document.getElementById('successModal'));
    myModal.show();
});
</script>
<?php } ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- SUCCESS POPUP -->
<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:#121212; color:white; border-radius:15px;">

      <div class="modal-header" style="border:none;">
        <h5 class="modal-title text-warning fw-bold">✔ Feedback Submitted</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center">
        <p>Your feedback has been submitted successfully.</p>
      </div>

      <div class="modal-footer" style="border:none;">
        <button class="btn btn-warning fw-bold px-4" data-bs-dismiss="modal">OK</button>
      </div>

    </div>
  </div>
</div>

</body>
</html>

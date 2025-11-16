<?php
session_start();
if (!isset($_SESSION['email'])) { header("Location: login.php"); exit(); }

// Correct include path
include("../backend/dbconnect.php");

$user_email = $_SESSION['email'];
$user_name = $_SESSION['username'];

// If event ID is passed → fetch event details
$event_id = isset($_GET['id']) ? $_GET['id'] : null;
$event_data = null;

if ($event_id) {
    $query = mysqli_query($conn, "SELECT * FROM create_event WHERE event_id='$event_id'");
    $event_data = mysqli_fetch_assoc($query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tickets | KLE (CSE) Productions</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #050505;
            color: white;
            font-family: "Poppins", sans-serif;
        }

        .card-custom {
            background: rgba(255,255,255,0.08);
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.15);
            padding: 30px;
            margin-top: 120px;
            backdrop-filter: blur(8px);
        }

        .btn-yellow {
            background: #ffd800;
            color: black;
            font-weight: 600;
            border-radius: 10px;
        }

        .btn-yellow:hover {
            background: #e6c000;
        }

        .form-control {
            border-radius: 10px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
        }
        .form-control:focus {
            background: rgba(255,255,255,0.15);
            color: white;
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
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="view_events.php">Events</a></li>
                <li class="nav-item"><a class="nav-link active" href="book_event.php">Book Tickets</a></li>
                <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="feedback.php">Feedback</a></li>
                <li class="nav-item">
                    <span class="badge bg-warning text-dark mx-2">
                        <i class="fa fa-user"></i> <?php echo $user_name; ?>
                    </span>
                </li>
                <li class="nav-item">
                    <a href="../backend/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container">
    <div class="col-md-6 mx-auto">

        <div class="card-custom">

            <h3 class="fw-bold mb-3">Book Your Seat</h3>
            <p class="text-warning">Fill the details below to register for this event</p>

            <!-- FORM -->
           <form action="../backend/book_event_action.php" method="POST">

    <div class="mb-3">
        <label class="form-label">Your Name</label>
        <input type="text" class="form-control" name="user_name" 
               value="<?php echo $user_name; ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Your Email</label>
        <input type="email" class="form-control" name="user_email" 
               value="<?php echo $user_email; ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Select Event</label>

        <select name="event_id" class="form-control" required>
            <?php if ($event_data) { ?>
                <option value="<?php echo $event_data['event_id']; ?>">
                    <?php echo $event_data['title']; ?>
                </option>
            <?php } ?>

            <option disabled>─────────────</option>

            <?php
            $all = mysqli_query($conn, "SELECT * FROM create_event ORDER BY title ASC");
            while ($ev = mysqli_fetch_assoc($all)) {
            ?>
                <option value="<?php echo $ev['event_id']; ?>">
                    <?php echo $ev['title']; ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <button type="submit" name="book" class="btn btn-yellow w-100 mt-3">
        Book Ticket
    </button>

</form>

            

        </select>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

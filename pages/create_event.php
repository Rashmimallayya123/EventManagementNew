<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
$user = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event | Event Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: url('../assets/images/bg.jpg') center/cover fixed no-repeat;
        }
        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.75);
        }
        .content {
            position: relative;
            z-index: 2;
            padding-top: 90px;
            padding-bottom: 60px;
        }
        .navbar-dark {
            background: rgba(0,0,0,0.9);
        }
        .card-glass {
            background: rgba(0,0,0,0.75);
            border-radius: 20px;
            padding: 25px 30px;
            border: 1px solid rgba(255,255,255,0.15);
            color: #fff;
            box-shadow: 0 10px 35px rgba(0,0,0,0.7);
        }
        .form-control, .form-select {
            border-radius: 12px;
            padding: 10px 12px;
            border: 1px solid rgba(255,255,255,0.3);
            background: rgba(0,0,0,0.4);
            color: #fff;
        }
        .form-control::placeholder {
            color: #aaa;
        }
        .btn-yellow {
            background: #ffd800;
            color: #000;
            border-radius: 999px;
            padding: 10px 28px;
            font-weight: 600;
            border: none;
        }
        .btn-yellow:hover {
            background: #e6c000;
        }
        label {
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="overlay"></div>

<!-- NAVBAR (same style as dashboard) -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">KLE(CSE) Productions</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link active" href="create_event.php">Create Event</a></li>
                <li class="nav-item"><a class="nav-link" href="view_events.php">Events</a></li>
                <li class="nav-item"><a class="nav-link" href="book_event.php">Book Tickets</a></li>
                <li class="nav-item ms-lg-3">
                    <span class="badge bg-warning text-dark">
                        <i class="fa fa-user me-1"></i><?php echo htmlspecialchars($user); ?>
                    </span>
                </li>
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-sm btn-outline-light" href="../backend/logout.php">
                        <i class="fa fa-sign-out-alt me-1"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- PAGE CONTENT -->
<div class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card-glass">
                    <h3 class="mb-3"><i class="fa fa-plus-circle me-2 text-warning"></i>Create New Event</h3>
                    <p class="text-muted mb-4" style="font-size: 14px;">
                        Fill the details below to create a new event for your college – hackathon, workshop, fest, seminar, etc.
                    </p>

                    <form action="../backend/create_event.php" method="POST">
                        <div class="mb-3">
                            <label>Event Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Ex: CodeSprint Hackathon"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3"
                                      placeholder="Short description about the event..." required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Date</label>
                                <input type="date" name="event_date" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Time</label>
                                <input type="time" name="event_time" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Venue</label>
                            <input type="text" name="venue" class="form-control"
                                   placeholder="Ex: CSE Seminar Hall, Main Auditorium" required>
                        </div>

                        <div class="mb-3">
                            <label>Publish Now?</label>
                            <select name="publish_event" class="form-select">
                                <option value="yes">Yes, make it visible to students</option>
                                <option value="no" selected>Save as draft</option>
                            </select>
                        </div>

                        <input type="hidden" name="created_by" value="<?php echo htmlspecialchars($_SESSION['email']); ?>">

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="dashboard.php" class="text-light text-decoration-none">
                                <i class="fa fa-arrow-left me-1"></i> Back to Dashboard
                            </a>
                            <button type="submit" name="submit" class="btn-yellow">
                                Create Event
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php if (isset($_GET['success']) && $_GET['success'] == 1) { ?>
<!-- SUCCESS TOAST -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="eventToast" class="toast align-items-center text-bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                🎉 Event created successfully!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto"
                data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let toastEl = document.getElementById('eventToast');
    let toast = new bootstrap.Toast(toastEl);
    toast.show();
});
</script>
<?php } ?>

</body>
</html>

</body>
</html>

<?php
session_start();
if (!isset($_SESSION['email'])) { header("Location: login.php"); exit(); }
$user = $_SESSION['username'];

include("../backend/dbconnect.php");

// IMPORTANT: Show only APPROVED + PUBLISHED events
$events = mysqli_query($conn, "
    SELECT * FROM create_event 
    WHERE status='approved' AND publish_event=1
    ORDER BY event_date ASC
");

$is_admin = false;  // Students should NOT get admin buttons
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events | KLE (CSE) Productions</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #050505;
            font-family: "Poppins", sans-serif;
            color: #fff;
        }
        .navbar-dark { background: rgba(0,0,0,0.9); }

        .event-section-title {
            margin-top: 40px;
            margin-bottom: 20px;
        }

        .event-card {
            background: rgba(255,255,255,0.08);
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s;
            border: 1px solid rgba(255,255,255,0.12);
        }
        .event-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .event-card:hover {
            transform: translateY(-6px);
            border-color: #ffd800;
            box-shadow: 0 12px 30px rgba(0,0,0,0.5);
        }
        .event-body {
            padding: 15px 18px 20px;
        }
        .btn-yellow {
            background: #ffd800;
            color: #000;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn-yellow:hover { background: #e6c000; }

        .modal-content {
            background: #121212;
            color: white;
            border-radius: 15px;
            border: 1px solid #333;
        }
        .btn-close-white {
            filter: invert(1);
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">KLE (CSE) Productions</a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link active" href="view_events.php">Events</a></li>
                <li class="nav-item"><a class="nav-link" href="create_event.php">Create Event</a></li>
                <li class="nav-item"><a class="nav-link" href="book_event.php">Book Tickets</a></li>
                <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="feedback.php">Feedback</a></li>
                <li class="nav-item ms-3">
                    <span class="badge bg-warning text-dark">
                        <i class="fa fa-user"></i> <?php echo $user; ?>
                    </span>
                </li>
                <li class="nav-item ms-2">
                    <a class="btn btn-sm btn-outline-light" href="../backend/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container" style="padding-top: 110px;">

    <!-- FIXED ONGOING EVENTS -->
    <h3 class="event-section-title fw-bold">🔥 Ongoing Campus Activities (Always Active)</h3>

    <div class="row g-4">

        <?php 
        $ongoing = [
            ["Saturday Counseling & Mentoring Hour", "Academic, career, and personal guidance available every Saturday.", "ongoing1.jpg"],
            ["Monthly Blood Donation Camp", "On the 1st Day of Every Month.", "ongoing2.jpg"],
            ["Weekly Coding & Problem-Solving Hour", "Every Wednesday: DSA, CP, interview questions.", "ongoing3.jpg"],
            ["Monthly Alumni Interaction", "Last Saturday: Placements & tech insights.", "ongoing4.jpg"],
            ["Campus Cleanliness / NSS Social Work", "1st Sunday: Tree plantation & social work.", "ongoing5.jpg"],
            ["Weekly Club Activity Day", "Every Thursday: Robotics, Coding, Cultural, E-cell.", "ongoing6.jpg"],
        ];

        $i = 1;
        foreach ($ongoing as $e) { ?>
            
            <div class="col-md-4">
                <div class="event-card">
                    <img src="../assets/images/<?php echo $e[2]; ?>" onerror="this.src='../assets/images/default.jpg'">
                    <div class="event-body">
                        <h5 class="fw-bold"><?php echo $e[0]; ?></h5>
                        <p class="small mt-2"><?php echo $e[1]; ?></p>

                        <button class="btn btn-yellow btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#modal<?php echo $i; ?>">
                            Know More
                        </button>
                    </div>
                </div>
            </div>

        <?php $i++; } ?>

    </div>


<!-- UPCOMING EVENTS -->
<h3 class="event-section-title fw-bold mt-4">📅 Upcoming & Created Events</h3>

<div class="row g-4">

    <?php while ($row = mysqli_fetch_assoc($events)) { ?>

        <div class="col-md-4">
            <div class="event-card">

                <img src="../assets/images/event_default.jpg">

                <div class="event-body">

                    <h5 class="fw-bold"><?php echo $row['title']; ?></h5>

                    <p class="small mt-2"><?php echo $row['description']; ?></p>

                    <p class="small mt-2 mb-1">
                        <i class="fa fa-calendar text-warning"></i> <?php echo $row['event_date']; ?>
                    </p>

                    <p class="small mb-1">
                        <i class="fa fa-clock text-warning"></i> <?php echo $row['event_time']; ?>
                    </p>

                    <p class="small mb-2">
                        <i class="fa fa-location-dot text-warning"></i> <?php echo $row['venue']; ?>
                    </p>

                    <!-- VIEW DETAILS -->
                    <a href="view_event_details.php?id=<?php echo $row['event_id']; ?>" 
                       class="btn btn-outline-light btn-sm">
                       <i class="fa fa-eye"></i> View
                    </a>

                </div>

            </div>
        </div>

    <?php } ?>

</div>

<!-- MODALS FOR ONGOING EVENTS -->
<?php 
$modal_details = [
    [
        "title" => "Saturday Counseling & Mentoring Hour",
        "body"  => "Weekly counseling for academic, career, and personal support from senior faculty mentors every Saturday.",
        "freq"  => "Every Saturday"
    ],
    [
        "title" => "Monthly Blood Donation Camp",
        "body"  => "Organized on the 1st of every month in association with KLES Hospital.",
        "freq"  => "1st Day of Every Month"
    ],
    [
        "title" => "Weekly Coding & Problem-Solving Hour",
        "body"  => "Every Wednesday: DSA problems, competitive programming, and interview coding.",
        "freq"  => "Every Wednesday"
    ],
    [
        "title" => "Monthly Alumni Interaction",
        "body"  => "Last Saturday each month: Alumni share industry insights & placement guidance.",
        "freq"  => "Last Saturday"
    ],
    [
        "title" => "Campus Cleanliness / NSS Social Work",
        "body"  => "1st Sunday: Tree plantation, campus cleanliness, and community service.",
        "freq"  => "1st Sunday"
    ],
    [
        "title" => "Weekly Club Activity Day",
        "body"  => "Every Thursday: Robotics Club, Coding Club, Cultural Club, and E-Cell activities.",
        "freq"  => "Every Thursday"
    ]
];

$j = 1;
foreach ($modal_details as $md) { ?>

<div class="modal fade" id="modal<?php echo $j; ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title fw-bold"><?php echo $md['title']; ?></h4>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <p class="mb-3" style="line-height:1.7;">
                    <?php echo $md['body']; ?>
                </p>

                <p><i class="fa fa-clock text-warning"></i> <strong>Frequency:</strong> <?php echo $md['freq']; ?></p>
                <p><i class="fa fa-users text-warning"></i> <strong>Organized By:</strong> KLE (CSE) Department</p>

            </div>

            <div class="modal-footer">
                <button class="btn btn-yellow" data-bs-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>

<?php $j++; } ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

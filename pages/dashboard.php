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
    <title>Dashboard | Event Management</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: #050505;
            color: #fff;
        }

        .hero-bg {
            background: url('../assets/images/bg.jpg') center/cover no-repeat fixed;
            position: relative;
        }

        .hero-overlay {
            background: rgba(0,0,0,0.75);
            width: 100%;
            height: 100%;
            position: absolute;
            inset: 0;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 90px 0 60px;
        }

        .navbar-dark {
            background: rgba(0,0,0,0.90);
        }

        .feature-card {
            background: rgba(0,0,0,0.75);
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.08);
            transition: transform .25s, box-shadow .25s, border-color .25s;
        }

        .feature-card i {
            font-size: 32px;
            margin-bottom: 12px;
            color: #ffd800;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            border-color: #ffd800;
            box-shadow: 0 12px 35px rgba(0,0,0,0.7);
        }

        .stats-pill {
            background: rgba(0,0,0,0.7);
            border-radius: 999px;
            padding: 10px 18px;
            font-size: 14px;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .services-section {
            padding: 70px 0;
        }

        .service-card {
            background: rgba(0,0,0,0.75);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.1);
            transition: transform .25s, box-shadow .25s, border-color .25s;
        }

        .service-card img {
            width: 100%;
            height: 140px;
            object-fit: cover;
        }

        .service-card-body {
            padding: 16px 18px 20px;
        }

        .service-card:hover {
            transform: translateY(-6px);
            border-color: #ffd800;
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
        }

        .cta-section {
            background: #ffd800;
            color: #000;
            padding: 60px 0;
            text-align: center;
        }

        .cta-btn {
            border-radius: 999px;
            padding: 10px 24px;
            font-weight: 600;
            margin: 8px;
            border: 2px solid #000;
        }

        .cta-btn-outline {
            background: transparent;
        }

        .cta-btn-outline:hover {
            background: #000;
            color: #ffd800;
        }

        .cta-btn-black {
            background: #000;
            color: #ffd800;
        }

        .cta-btn-black:hover {
            background: transparent;
            color: #000;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">
            KLE(CSE) Productions
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="view_events.php">Events</a></li>
                <li class="nav-item"><a class="nav-link" href="book_event.php">Book Tickets</a></li>
                <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="feedback.php">Feedback</a></li>
                <li class="nav-item"><a class="nav-link" href="host_event.php">Host Event</a></li>
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

<!-- HERO + FEATURE TILES -->
<section class="hero-bg">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-lg-7">
                    <div class="stats-pill d-inline-flex align-items-center mb-3">
                        <i class="fa fa-bolt me-2 text-warning"></i>
                        Engineering Events • Hackathons • Fests • Workshops
                    </div>
                    <h1 class="display-5 fw-bold mb-3">
                        Manage & Experience<br/>Campus Events Like a Pro.
                    </h1>
                    <p class="lead mb-4">
                        Create events, manage registrations, book tickets, and showcase your college
                        activities in one sleek dashboard.
                    </p>
                </div>
            </div>

            <!-- Feature tiles -->
            <div class="row g-4">
                <div class="col-md-4">
                    <a class="text-decoration-none text-white" href="create_event.php">
                        <div class="feature-card">
                            <i class="fa fa-plus-circle"></i>
                            <h5 class="mt-2 mb-1">Create Event</h5>
                            <p class="small mb-0">Plan hackathons, fests, workshops & seminars with full control.</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a class="text-decoration-none text-white" href="view_events.php">
                        <div class="feature-card">
                            <i class="fa fa-calendar-days"></i>
                            <h5 class="mt-2 mb-1">View Events</h5>
                            <p class="small mb-0">Browse all upcoming & past events happening on campus.</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a class="text-decoration-none text-white" href="book_event.php">
                        <div class="feature-card">
                            <i class="fa fa-ticket"></i>
                            <h5 class="mt-2 mb-1">Book Tickets</h5>
                            <p class="small mb-0">Reserve your seat instantly for tech talks, fests & concerts.</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a class="text-decoration-none text-white" href="my_registrations.php">
                        <div class="feature-card mt-3">
                            <i class="fa fa-user-check"></i>
                            <h5 class="mt-2 mb-1">My Registrations</h5>
                            <p class="small mb-0">Track events you’ve registered for & your ticket status.</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a class="text-decoration-none text-white" href="gallery.php">
                        <div class="feature-card mt-3">
                            <i class="fa fa-image"></i>
                            <h5 class="mt-2 mb-1">Event Gallery</h5>
                            <p class="small mb-0">Relive memories from previous events & fests.</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a class="text-decoration-none text-white" href="host_event.php">
                        <div class="feature-card mt-3">
                            <i class="fa fa-paper-plane"></i>
                            <h5 class="mt-2 mb-1">Host an Event</h5>
                            <p class="small mb-0">Submit your idea to organize the next big campus event.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- OUR SERVICES -->
<section class="services-section">
    <div class="container">
        <h2 class="text-center mb-4">OUR SERVICES</h2>
        <p class="text-center text-muted mb-5">
            Everything you need to plan, promote and manage engineering college events.
        </p>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="service-card">
                    <img src="../assets/images/service1.jpg" alt="Live Events">
                    <div class="service-card-body">
                        <h6>Tech Fests & Hackathons</h6>
                        <p class="small mb-0">Plan multi-day fests, coding contests and technical competitions.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="service-card">
                    <img src="../assets/images/service2.jpg" alt="Workshops">
                    <div class="service-card-body">
                        <h6>Workshops & Seminars</h6>
                        <p class="small mb-0">Schedule skill-based workshops and expert sessions for students.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="service-card">
                    <img src="../assets/images/service3.jpg" alt="Cultural">
                    <div class="service-card-body">
                        <h6>Cultural & Music Events</h6>
                        <p class="small mb-0">Manage concerts, cultural nights, freshers’ & farewell events.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- YELLOW CTA SECTION -->
<section class="cta-section">
    <div class="container">
        <h2 class="fw-bold mb-3">PLANNING YOUR NEXT EVENT?</h2>
        <p class="mb-4">
            Whether it’s a hackathon, tech fest or cultural night, we help you manage everything smoothly.
        </p>
        <button class="cta-btn cta-btn-black" onclick="window.location.href='host_event.php'">
            Let's Talk
        </button>
        <button class="cta-btn cta-btn-outline" onclick="window.location.href='view_events.php'">
            See Our Events
        </button>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

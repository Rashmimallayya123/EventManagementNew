<?php
session_start();
if (!isset($_SESSION['email'])) { header("Location: login.php"); exit(); }
$user = $_SESSION['username'];

include("../backend/dbconnect.php");

// Get all gallery images
$images = mysqli_query($conn, "SELECT * FROM gallery ORDER BY uploaded_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gallery | KLE (CSE) Productions</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #050505; 
            color: white; 
            font-family: 'Poppins', sans-serif;
        }

        .gallery-card {
            background: rgba(255,255,255,0.08);
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.12);
            transition: 0.3s;
        }

        .gallery-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            cursor: pointer;
        }

        .gallery-card:hover {
            transform: scale(1.02);
            border-color: #ffd800;
        }

        .btn-yellow {
            background: #ffd800; 
            border-radius: 8px; 
            color: #000; 
            font-weight: 600;
        }
        .btn-yellow:hover { background: #e6c000; }

        .modal-content {
            background: #121212;
            border-radius: 15px;
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
                <li class="nav-item"><a class="nav-link" href="book_event.php">Book Tickets</a></li>
                <li class="nav-item"><a class="nav-link active" href="gallery.php">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="feedback.php">Feedback</a></li>

                <li class="nav-item">
                    <span class="badge bg-warning text-dark mx-2">
                        <i class="fa fa-user"></i> <?php echo $user; ?>
                    </span>
                </li>

                <li class="nav-item"><a class="btn btn-outline-light btn-sm" href="../backend/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container" style="padding-top:110px;">

    <h2 class="fw-bold mb-4">📸 Event Gallery</h2>

    <!-- Upload Form -->
    <div class="card p-4 bg-dark border-light mb-4">
        <h5>Upload Image</h5>
        <form action="../backend/upload_image.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="title" class="form-control" placeholder="Enter Image Title" required>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-yellow w-100">Upload</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Gallery Grid -->
    <div class="row g-4">

        <?php while ($img = mysqli_fetch_assoc($images)) { ?>
            
            <div class="col-md-4">
                <div class="gallery-card">
                    <img src="../assets/gallery/<?php echo $img['image_path']; ?>" 
                         data-bs-toggle="modal" 
                         data-bs-target="#modal<?php echo $img['id']; ?>">

                    <div class="p-3">
                        <h5><?php echo $img['title']; ?></h5>
                        <p class="small text-secondary">Uploaded: <?php echo $img['uploaded_at']; ?></p>
                    </div>
                </div>
            </div>

            <!-- MODAL -->
            <div class="modal fade" id="modal<?php echo $img['id']; ?>">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5><?php echo $img['title']; ?></h5>
                            <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body text-center">
                            <img src="../assets/gallery/<?php echo $img['image_path']; ?>" 
                                 class="img-fluid rounded">
                        </div>

                    </div>
                </div>
            </div>

        <?php } ?>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- UNIVERSAL SUCCESS POPUP -->
<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:#121212; color:white; border-radius:15px;">

      <div class="modal-header" style="border:none;">
        <h5 class="modal-title text-warning fw-bold">✔ Success</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center" id="successMessage">
        <!-- Message will be injected dynamically -->
      </div>

      <div class="modal-footer" style="border:none;">
        <button class="btn btn-warning fw-bold px-4" data-bs-dismiss="modal">OK</button>
      </div>

    </div>
  </div>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .hero-section {
            background: url('assets/images/bg.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
        }

        .hero-overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            top: 0;
            left: 0;
        }

        .hero-content {
            z-index: 2;
        }

        .btn-custom {
            padding: 12px 35px;
            font-size: 18px;
            border-radius: 50px;
            margin: 10px;
        }

        .title {
            font-size: 50px;
            font-weight: 700;
        }

        .subtitle {
            font-size: 20px;
            margin-bottom: 40px;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <h1 class="title">Welcome to Event Management</h1>
            <p class="subtitle">Manage, Organize & Participate in Events Easily</p>

            <a href="pages/login.php" class="btn btn-warning btn-custom">Login</a>
            <a href="pages/signup.php" class="btn btn-light btn-custom">Sign Up</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

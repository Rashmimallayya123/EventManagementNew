<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Event Management</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('../assets/images/bg.jpg') no-repeat center center/cover;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.55);
        }

        .login-box {
            position: relative;
            z-index: 2;
            max-width: 420px;
            margin: auto;
            margin-top: 120px;
            padding: 35px;
            background: rgba(255,255,255,0.12);
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            color: white;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
        }

        .btn-login {
            padding: 12px;
            width: 100%;
            border-radius: 12px;
            font-size: 18px;
            background: #ffc107;
            border: none;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #e0a800;
        }

        .register-link {
            margin-top: 15px;
            text-align: center;
        }

        .register-link a {
            color: #ffc107;
            font-weight: bold;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="overlay"></div>

<div class="login-box">
    <h2 class="text-center mb-4">Login</h2>

    <form action="../backend/log_in.php" method="POST">

        <div class="mb-3">
            <label>Email</label>
            <input type="text" class="form-control" name="username" placeholder="Enter your Email" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
        </div>

        <!-- 🔥 FIXED: added name="submit" -->
        <button type="submit" name="submit" class="btn-login">Login</button>

        <div class="register-link">
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

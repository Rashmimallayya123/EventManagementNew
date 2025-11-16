<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Logging Out...</title>
    <meta http-equiv="refresh" content="2;url=admin_login.php">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { 
            background: #050505; 
            color: white; 
            font-family: Poppins; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh;
        }
        .box {
            background: rgba(255,255,255,0.1);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.3);
            backdrop-filter: blur(8px);
        }
    </style>
</head>
<body>

<div class="box">
    <h3 class="text-warning">🔐 Admin Logged Out</h3>
    <p>Redirecting to admin login...</p>
</div>

</body>
</html>

<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial;
            background: #1c1c1c;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: #2e2e2e;
            padding: 25px;
            width: 320px;
            border-radius: 10px;
            box-shadow: 0 0 10px black;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: none;
        }
        button {
            background: #6a00ff;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background: #5200cc;
        }
    </style>
</head>

<body>

<div class="login-box">
    <h2>Admin Login</h2>

    <?php if(isset($_GET["error"])) { ?>
        <p style="color: red;">Invalid username or password</p>
    <?php } ?>

    <form action="admin_auth.php" method="POST">
        <input type="text" name="username" placeholder="Admin Username" required>
        <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="admin_login" class="btn btn-primary">Login</button>


    </form>
</div>

</body>
</html>



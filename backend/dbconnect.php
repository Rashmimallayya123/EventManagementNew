<?php
$host = "trolley.proxy.rlwy.net";
$user = "root";
$pass = "ZNWGAyoXgMrKcirDdZxEvSuYOQWtbtIe";
$db   = "railway";
$port = 43547;

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

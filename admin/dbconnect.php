<?php
$host = "trolley.proxy.rlwy.net";   // your Railway host
$user = "root";
$password = "ZNWGAyoXgMrKcirDdZxEvSuYOQWtbtIe";   // your Railway password
$port = 43547;                      // your Railway port
$database = "railway";

$conn = mysqli_connect($host, $user, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

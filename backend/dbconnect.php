<?php
$host = "crossover.proxy.rlwy.net";
$port = 20185;
$username = "root";
$password = "zZqBbAojKqrZwtzoAHcgIuSvfaPcijOI";
$database = "railway";

$conn = mysqli_connect($host, $username, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

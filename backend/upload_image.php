<?php
session_start();
include("dbconnect.php");

$title = $_POST['title'];

if (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {
    echo "<script>alert('No image selected!'); window.location.href='../pages/gallery.php';</script>";
    exit();
}

$filename = time() . "_" . basename($_FILES["image"]["name"]);
$target_path = "../assets/gallery/" . $filename;

if (!is_dir("../assets/gallery/")) {
    mkdir("../assets/gallery/", 0777, true);
}

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_path)) {

    mysqli_query($conn, 
        "INSERT INTO gallery(title, image_path) VALUES('$title', '$filename')"
    );

    echo "<script>alert('Image Uploaded Successfully!'); window.location.href='../pages/gallery.php';</script>";
} 
else {
    echo "<script>alert('Upload Failed!'); window.location.href='../pages/gallery.php';</script>";
}
?>

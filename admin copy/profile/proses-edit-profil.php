<?php
session_start();
require_once "../../koneksi.php";

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../../login/login.php"); // Redirect to login page if not logged in
    exit();
}

$userID = $_POST['id']; // Get user ID from form
$namaLengkap = $_POST['nama_lengkap'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// Handle file upload
$profilePicture = '';
if (!empty($_FILES['profile_picture']['name'])) {
    $targetDir = "../../uploaded_img/";
    $profilePicture = basename($_FILES['profile_picture']['name']);
    $targetFilePath = $targetDir . $profilePicture;
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFilePath);
}

// Update user data
if ($profilePicture) {
    $query = "UPDATE user SET nama_lengkap='$namaLengkap', alamat='$alamat', telepon='$telepon', email='$email', username='$username', password='$password', image='$profilePicture' WHERE id='$userID'";
} else {
    $query = "UPDATE user SET nama_lengkap='$namaLengkap', alamat='$alamat', telepon='$telepon', email='$email', username='$username', password='$password' WHERE id='$userID'";
}

if (mysqli_query($connect, $query)) {
    header("Location: ../index.php");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connect);
}

mysqli_close($connect);
?>

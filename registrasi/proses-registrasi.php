<?php
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $otoritas = $_POST['otoritas'];

    // Query untuk memeriksa keberadaan username dan email
    $checkQuery = "SELECT * FROM user WHERE username = ? OR email = ?";
    $checkStmt = $connect->prepare($checkQuery);
    $checkStmt->bind_param("ss", $username, $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    // Periksa apakah username atau email sudah ada
    if ($result->num_rows > 0) {
        echo '<script>alert("Username atau email sudah terdaftar."); window.location.href = "registrasi.php";</script>';
        exit;
    }

    // Periksa apakah password cocok
    if ($password !== $cpassword) {
        echo '<script>alert("Password dan Konfirmasi Password tidak cocok."); window.location.href = "registrasi.php";</script>';
        exit;
    }

    // Insert user data into the database
    $query = "INSERT INTO user (username, email, password, otoritas, nama_lengkap, alamat, telepon, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("sssssss", $username, $email, $password, $otoritas, $nama_lengkap, $alamat, $telepon);

    if ($stmt->execute()) {
        echo '<script>alert("Registrasi Berhasil"); window.location.href = "../login/login.php";</script>';
    } else {
        echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href = "registrasi.php";</script>';
    }

    $stmt->close();
    $checkStmt->close();
}

$connect->close();
?>

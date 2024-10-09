<?php
include "../koneksi.php";

$username = $_POST["username"];
$password = $_POST["password"];

// Cek apakah username dan password sudah diisi
if (empty($username) || empty($password)) {
    echo "<script>alert('Username dan Password harus diisi!');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

// Siapkan pernyataan untuk mencegah SQL injection
$stmt = $connect->prepare("SELECT * FROM user WHERE username=? AND password=?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    // Berhasil login
    session_start();
    $_SESSION['id'] = $row['id'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['otoritas'] = $row['otoritas'];
    
    // Data pengguna untuk cookies
    setcookie('id_user', $row['id'], time() + (86400 * 30), "/");
    setcookie("username", $row['username'], time() + (86400 * 30), "/");
    setcookie("email", $row['email'], time() + (86400 * 30), "/");
    setcookie("otoritas", $row['otoritas'], time() + (86400 * 30), "/");
    setcookie("alamat", $row['alamat'], time() + (86400 * 30), "/");
    setcookie("telepon", $row['telepon'], time() + (86400 * 30), "/");
    setcookie("nama_lengkap", $row['nama_lengkap'], time() + (86400 * 30), "/");

    // Tutup prepared statement dan koneksi
    $stmt->close();
    $connect->close();

    // Redirect berdasarkan otoritas
    if ($row['otoritas'] == 'ADMIN') {
        header('location:../admin/index.php');
    } else {
        header('location:../member/index.php');
    }
    exit();
} else {
    // Jika username atau password salah
    echo "<script>alert('Username atau Password tidak benar!');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

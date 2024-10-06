<?php

include "../../koneksi.php";

// Menangani data yang dikirimkan dari form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$otoritas = $_POST['otoritas'];
$namaLengkap = $_POST['nama_lengkap'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];

// Periksa apakah username atau email sudah ada
$checkQuery = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";
$resultCheck = mysqli_query($connect, $checkQuery);

if (mysqli_num_rows($resultCheck) > 0) {
    // Jika username atau email sudah ada, tampilkan pesan error
    $row = mysqli_fetch_assoc($resultCheck);
    if ($row['username'] === $username && $row['email'] === $email) {
        $errorMsg = 'Username dan Email sudah ada. Silakan gunakan username dan email lain.';
    } elseif ($row['username'] === $username) {
        $errorMsg = 'Username sudah ada. Silakan gunakan username lain.';
    } elseif ($row['email'] === $email) {
        $errorMsg = 'Email sudah ada. Silakan gunakan email lain.';
    }
    echo "<script>
            alert('$errorMsg');
            window.history.back(); // Kembali ke halaman sebelumnya
          </script>";
} else {
    // Menambahkan data pengguna ke database
    $resultInsert = mysqli_query($connect, "INSERT INTO user (username, email, password, otoritas, nama_lengkap, alamat, telepon, created_at) VALUES ('$username', '$email', '$password', '$otoritas', '$namaLengkap', '$alamat', '$telepon', NOW())");

    if ($resultInsert) {
        echo "<script>
                alert('Data Berhasil Ditambahkan!');
                window.location.href='../index.php';
              </script>";
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error: " . mysqli_error($connect);
    }
}

?>

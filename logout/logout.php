<?php
session_start(); // Memulai sesi jika belum dimulai

// Menghapus semua variabel sesi
session_unset(); 

// Menghancurkan sesi
session_destroy(); 

// Menghapus semua cookie yang terkait dengan sesi
setcookie('username', '', time() - 3600, '/');
setcookie('email', '', time() - 3600, '/');
setcookie('otoritas', '', time() - 3600, '/'); // Perbaikan dari 'otortias' ke 'otoritas'
setcookie('alamat', '', time() - 3600, '/');
setcookie('telepon', '', time() - 3600, '/');
setcookie('nama_lengkap', '', time() - 3600, '/');

// Redirect ke halaman login atau halaman lain setelah logout
header('location:../index.php'); 
exit();

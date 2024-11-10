<?php
$username = 'root';
$serverName = 'host.docker.internal'; // Ganti localhost menjadi host.docker.internal
$password = '';  // Jika root MySQL Anda tidak punya password, biarkan kosong
$database = 'website_perpustakaan';

$connect = mysqli_connect($serverName, $username, $password, $database);

if (!$connect) {
    die("Connection failed!: " . mysqli_connect_error());
}

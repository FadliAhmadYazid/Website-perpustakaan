<?php
$username = 'root';
$serverName = 'localhost';
$password = '';
$database = 'website_perpustakaan';

$connect = mysqli_connect($serverName, $username, $password, $database);

if ($connect->connect_error) {
    die("Connection failed!: " . $connect->connect_error);
}


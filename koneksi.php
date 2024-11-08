<?php
$username = 'root';
$serverName = '/cloudsql/website-perpustakaan-440710:asia-southeast2:website-perpustakaan-db';
$password = '';
$database = 'website_perpustakaan';

$connect = mysqli_connect($serverName, $username, $password, $database);

if (!$connect) {
    die("Connection failed!: " . mysqli_connect_error());
}

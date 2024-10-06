<?php
require_once "../../koneksi.php";

if (isset($_POST['submit'])) {
    $judul_buku = $_POST['judul_buku'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $file = $_FILES['file']['name'];
    $image = $_FILES['image']['name'];

    // File upload
    $target_dir = "../../uploaded_file/";
    $target_file = $target_dir . basename($file);
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    // Image upload
    $target_dir = "../../uploaded_img/";
    $target_image = $target_dir . basename($image);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_image);

    // SQL Query
    $query = "INSERT INTO buku (judul_buku, penulis, penerbit, tahun_terbit, file, image, created_at) 
              VALUES ('$judul_buku', '$penulis', '$penerbit', '$tahun_terbit', '$file', '$image', CURRENT_TIMESTAMP)";

    if (mysqli_query($connect, $query)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}
?>

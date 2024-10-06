<?php

include "../../koneksi.php";

$id = $_POST['id'];
$judul_buku = $_POST['judul_buku'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun_terbit = $_POST['tahun_terbit'];

// Check if a new file is uploaded
if ($_FILES['file']['name']) {
    $file = $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], "../../uploaded_img/".$file);
} else {
    // Get the existing file name from the database
    $result = mysqli_query($connect, "SELECT file FROM buku WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);
    $file = $row['file'];
}

// Check if a new image is uploaded
if ($_FILES['image']['name']) {
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../../uploaded_img/".$image);
} else {
    // Get the existing image name from the database
    $result = mysqli_query($connect, "SELECT image FROM buku WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);
    $image = $row['image'];
}

$result = mysqli_query($connect, "UPDATE buku SET 
    judul_buku='$judul_buku', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun_terbit', 
    file='$file', image='$image'
    WHERE id='$id'");

if ($result) {
    echo "<script>
            alert('Edit Data Berhasil!');
            window.location.href='index.php';
          </script>";
} else {
    echo "Error: " . mysqli_error($connect);
}

?>

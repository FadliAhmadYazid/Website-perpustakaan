<?php

include '../../koneksi.php';

$ID = $_GET['id'];
mysqli_query($connect, "DELETE FROM buku WHERE id='$ID'");

header("location: index.php");

?>
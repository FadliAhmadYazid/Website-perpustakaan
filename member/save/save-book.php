<?php
include '../../koneksi.php';
session_start();

if (isset($_POST['book_id'])) {
    $bookID = $_POST['book_id'];
    $userID = $_SESSION['id'];
    $query = "INSERT INTO saved_books (user_id, book_id) VALUES ('$userID', '$bookID')";
    mysqli_query($connect, $query);
}

header("Location: ../index.php");
exit();
?>

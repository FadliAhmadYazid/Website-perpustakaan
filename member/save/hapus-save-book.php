<?php
include '../../koneksi.php';
session_start();

if (isset($_POST['book_id'])) {
    $bookID = $_POST['book_id'];
    $userID = $_SESSION['id'];
    $query = "DELETE FROM saved_books WHERE user_id='$userID' AND book_id='$bookID'";
    mysqli_query($connect, $query);
}

header("Location: ../index.php");
exit();
?>

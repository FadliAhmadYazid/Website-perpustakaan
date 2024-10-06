<?php
session_start();
include "../../koneksi.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../../login/login.php");
    exit();
}
$userID = $_SESSION['id'];
$query = "SELECT nama_lengkap, image FROM user WHERE id='$userID'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

$nama_lengkap = $row['nama_lengkap'];
$profilePicture = !empty($row['image']) ? "../../uploaded_img/" . $row['image'] : "../../assets/Default_Profile.png";

// Pagination settings
$limit = 6; // Number of books per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
$offset = ($page - 1) * $limit; // Offset for SQL query

$search = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';

// Fetch saved book data with pagination
$savedBookQuery = "SELECT buku.* FROM buku 
                   JOIN saved_books ON buku.id = saved_books.book_id 
                   WHERE saved_books.user_id='$userID'";

if (!empty($search)) {
    $savedBookQuery .= " AND buku.judul_buku LIKE '%$search%'";
}

$savedBookQuery .= " LIMIT $limit OFFSET $offset";

$savedBookResult = mysqli_query($connect, $savedBookQuery);

// Count total number of saved books
$totalSavedBooksQuery = "SELECT COUNT(*) as total FROM buku 
                         JOIN saved_books ON buku.id = saved_books.book_id 
                         WHERE saved_books.user_id='$userID'";

if (!empty($search)) {
    $totalSavedBooksQuery .= " AND buku.judul_buku LIKE '%$search%'";
}

$totalSavedBooksResult = mysqli_query($connect, $totalSavedBooksQuery);
$totalSavedBooksRow = mysqli_fetch_assoc($totalSavedBooksResult);
$totalSavedBooks = $totalSavedBooksRow['total'];
$totalSavedPages = ceil($totalSavedBooks / $limit); // Total number of pages for saved books
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../member.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container-fluid d-flex justify-content-center">
                <a class="navbar-brand me-auto" href="../../profile/index.php">
                    <img src="<?php echo $profilePicture; ?>" alt="" style="width: 40px; height:40px; border-radius:50%; border: 1px solid grey;" class="profile-picture">
                </a>
                <span class="full-name"><?php echo htmlspecialchars($nama_lengkap); ?></span>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link mx-lg-2" href="../index.php">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-lg-2 active" aria-current="page" href="#">Tersimpan</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <form action="../../logout/logout.php" method="post">
                    <button class="login-button">Keluar</button>
                </form>
                <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </header>

    <section class="first-section d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="container-fixed-width">
            <div class="input-box">
                <form method="GET" action="" class="mb-2">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari judul buku..." value="<?php echo htmlspecialchars($search); ?>">
                        <button class="btn search-btn" type="submit">Cari</button>
                    </div>
                </form>
                <div class="row row-cols-md-1 row-cols-md-2 row-cols-md-3 row-cols-md-4 row-cols-md-5 row-cols-md-6 justify-content-center">
                    <?php
                    // Loop through each saved book data fetched from the database
                    while ($book = mysqli_fetch_assoc($savedBookResult)) { 
                        // Construct the image path for the book cover
                        $imagePath = "../../uploaded_img/" . $book['image'];
                        $filePath = "../../uploaded_file/" . $book['file'];

                        // Check if the book is already saved by the user
                        $savedQuery = "SELECT * FROM saved_books WHERE user_id='$userID' AND book_id='" . $book['id'] . "'";
                        $savedResult = mysqli_query($connect, $savedQuery);
                        $isSaved = mysqli_num_rows($savedResult) > 0;
                    ?>
                        <div class="col">
                            <div class="card h-100">
                                <!-- Use the book cover image as the card image -->
                                <img src="<?php echo $imagePath; ?>" class="card-img-top portrait-img" alt="<?php echo $book['judul_buku']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $book['judul_buku']; ?></h5>
                                    <!-- Display other book details -->
                                    <p class="card-text">Penulis: <?php echo $book['penulis']; ?></p>
                                    <p class="card-text">Penerbit: <?php echo $book['penerbit']; ?></p>
                                    <p class="card-text">Tahun Terbit: <?php echo $book['tahun_terbit']; ?></p>

                                    <div class="d-flex mt-2">
                                        <?php
                                        // Construct the file path for the book file
                                        $filePath = "../../uploaded_file/" . $book['file']; // Assuming 'file' column in the database stores the file name
                                        // Check if the file exists
                                        if (file_exists($filePath)) :
                                        ?>
                                            <a href="<?php echo $filePath; ?>" class="btn eye-btn" style="margin-right: 10px;" target="_blank"><img src="../../assets/eyefill.svg" alt=""></a>
                                        <?php else : ?>
                                            <p class="text-danger">File tidak tersedia</p>
                                        <?php endif; ?>
                                        <!-- Save button -->
                                        <?php
                                        // Check if the book is saved or not
                                        $bookSavedQuery = "SELECT * FROM saved_books WHERE user_id='$userID' AND book_id='{$book['id']}'";
                                        $bookSavedResult = mysqli_query($connect, $bookSavedQuery);
                                        $isBookSaved = mysqli_num_rows($bookSavedResult) > 0;
                                        
                                        // Set class and image based on whether the book is saved or not
                                        $buttonClass = $isBookSaved ? 'btn bookmark-btn bookmarked' : 'btn bookmark-btn';
                                        $buttonImage = $isBookSaved ? 'bookmark.svg' : 'bookmark1.svg';
                                        ?>
                                        <?php if ($isBookSaved) : ?>
                                            <form action="hapus-save-book.php" method="post" class="d-flex">
                                                <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                                                <button type="submit" class="btn bookmark-btn">
                                                    <img src="../../assets/<?php echo $buttonImage; ?>" alt="Bookmark">
                                                </button>
                                            </form>
                                        <?php else : ?>
                                            <form action="save-book.php" method="post" class="d-flex">
                                                <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                                                <button type="submit" class="btn bookmark-btn">
                                                    <img src="../../assets/<?php echo $buttonImage; ?>" alt="Bookmark">
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1) : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>">Previous</a></li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalSavedPages; $i++) : ?>
                            <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>
                        <?php if ($page < $totalSavedPages) : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>">Next</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</body>

</html>

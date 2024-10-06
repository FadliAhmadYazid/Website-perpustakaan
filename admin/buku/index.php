<?php
session_start();
include "../../koneksi.php";

$userID = $_SESSION['id'];
$query = "SELECT nama_lengkap, image FROM user WHERE id='$userID'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

$nama_lengkap = $row['nama_lengkap'];
$profilePicture = !empty($row['image']) ? "../../uploaded_img/" . $row['image'] : "../../assets/Default_Profile.png";


// Konfigurasi pagination
$limit = 4; // Jumlah baris per halaman
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Halaman saat ini
$start = ($page - 1) * $limit; // Titik mulai data

// Mengambil nilai pencarian dari parameter GET
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Mengubah query SELECT buku dengan menambahkan kondisi WHERE untuk pencarian
$query = "SELECT * FROM buku WHERE judul_buku LIKE '%$search%' LIMIT $start, $limit";

// Mengambil data dari database dengan batasan dan menggunakan query yang telah dimodifikasi
$result = mysqli_query($connect, $query);

// Menghitung total data
$total_results = mysqli_query($connect, "SELECT COUNT(*) AS total FROM buku WHERE judul_buku LIKE '%$search%'");
$total_rows = mysqli_fetch_assoc($total_results)['total'];
$total_pages = ceil($total_rows / $limit); // Menghitung jumlah total halaman
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="bukuu.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container-fluid d-flex justify-content-center">
                <a class="navbar-brand me-auto" href="../profile/index.php">
                    <img src="<?php echo $profilePicture; ?>" alt="" class="profile-picture">
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
                                <a class="nav-link mx-lg-2 " href="../index.php">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-lg-2" href="../user/index.php">Data Pengguna</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-lg-2 active" aria-current="page" href="#">Data Buku</a>
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
                <!-- Tambahkan tombol "Tambah Buku" di sini -->
                <div class="action-button-bottom d-flex justify-content-start mb-3">
                    <a href="tambah-buku.php" class="btn btn-success me-3" type="button">Tambah Buku</a>
                    <a href="cetak-data.php" class="btn btn-primary" type="button">
                        <img src="../../assets/printer.svg" alt="Logo" style="margin-right: 7px; margin-top: 3px;">Cetak Data
                    </a>
                    <form method="GET" action="" class="search">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari judul buku..." value="<?php echo htmlspecialchars($search); ?>">
                        <button class="btn search-btn" type="submit">Cari</button>
                    </div>
                    </form>
                </div>
                <!-- Tabel dan navigasi tetap di sini -->
                <table class="table table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Penerbit</th>
                            <th scope="col">Tahun Terbit</th>
                            <th scope="col">File</th>
                            <th scope="col">Image</th>
                            <th scope="col">Di Input Pada</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <?php
                    $rowNumber = $start + 1;
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $rowNumber++ ?></td>
                            <td><?php echo $row['judul_buku'] ?></td>
                            <td><?php echo $row['penulis'] ?></td>
                            <td><?php echo $row['penerbit'] ?></td>
                            <td><?php echo $row['tahun_terbit'] ?></td>
                            <td><a href="../../uploaded_file/<?php echo $row['file']; ?>"><?php echo $row['file']; ?></a></td>
                            <td><img src="../../uploaded_img/<?php echo $row['image']; ?>" alt="image" width="50"></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($row['created_at'])); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="edit-buku.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-warning"><img src="../../assets/pencil.svg" alt=""></button></a>
                                    <a href="hapus-buku.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-danger"><img src="../../assets/trash.svg" alt=""></button></a>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <!-- Navigasi halaman -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1) : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo $search; ?>">Previous</a></li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                            <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>
                        <?php if ($page < $total_pages) : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo $search; ?>">Next</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
    </section>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>

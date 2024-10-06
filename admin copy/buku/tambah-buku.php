<?php
require_once "../../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../login/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>
<body>
    <section class="first-section d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="back-button">
            <a href="index.php">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="input-box text-center">
            <h2>Tambah Buku</h2>
            <p></p>
            <form action="proses-tambah-buku.php" method="post" enctype="multipart/form-data">
                <div class="input-group flex-nowrap mb-3">
                    <span class="input-group-text" id="addon-wrapping">
                        <img src="../../assets/book1.svg" alt="">
                    </span>
                    <input class="form-control" placeholder="Judul Buku" type="text" aria-label="Judul Buku" aria-describedby="addon-wrapping" name="judul_buku" required>
                </div>
                <div class="input-group flex-nowrap mb-3">
                    <span class="input-group-text" id="addon-wrapping">
                        <img src="../../assets/profile.svg" alt="">
                    </span>
                    <input class="form-control" placeholder="Penulis" type="text" aria-label="Penulis" aria-describedby="addon-wrapping" name="penulis" required>
                </div>
                <div class="input-group flex-nowrap mb-3">
                    <span class="input-group-text" id="addon-wrapping">
                        <img src="../../assets/profile.svg" alt="">
                    </span>
                    <input class="form-control" placeholder="Penerbit" type="text" aria-label="Penerbit" aria-describedby="addon-wrapping" name="penerbit" required>
                </div>
                <div class="input-group flex-nowrap mb-3">
                    <span class="input-group-text" id="addon-wrapping">
                        <img src="../../assets/calendar.svg" alt="">
                    </span>
                    <input class="form-control" placeholder="Tahun Terbit" type="text" aria-label="Tahun Terbit" aria-describedby="addon-wrapping" name="tahun_terbit" required>
                </div>
                <div class="input-group flex-nowrap mb-3">
                    <span class="input-group-text" id="addon-wrapping">
                        <img src="../../assets/pdf.svg" alt="">
                    </span>
                    <input class="form-control" placeholder="Upload File" type="file" aria-label="File" aria-describedby="addon-wrapping" name="file" required>
                </div>
                <div class="input-group flex-nowrap mb-3">
                    <span class="input-group-text" id="addon-wrapping">
                        <img src="../../assets/image.svg" alt="">
                    </span>
                    <input class="form-control" placeholder="Upload Image" type="file" aria-label="Image" aria-describedby="addon-wrapping" name="image" required>
                </div>
                <div class="input-group flex-nowrap mb-3">
                    <button type="submit" name="submit" value="Tambah Buku" class="login-button">Tambah Buku</button>
                </div>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

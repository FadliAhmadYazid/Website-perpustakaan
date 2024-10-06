<?php
require_once "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>

<body>
    <section class="first-section d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="back-button">
            <a href="../index.php">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="input-box text-center">
            <h2>Masuk</h2>
            <p></p>
            <form action="proses-login.php" method="post">
                <div class="input-group flex-nowrap mb-3">
                    <span class="input-group-text" id="addon-wrapping">
                        <img src="../assets/profile.svg" alt="">
                    </span>
                    <input class="form-control" placeholder="Username" type="text" aria-label="Username" aria-describedby="addon-wrapping" name="username" required>
                </div>
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">
                        <img src="../assets/password.svg" alt="">
                    </span>
                    <input class="form-control" placeholder="Password" type="password" aria-label="Password" aria-describedby="addon-wrapping" name="password" required>
                </div>
                <br>
                <div class="input-group flex-nowrap mb-2">
                    <button type="submit" class="login-button">Masuk</button>
                </div>
                <br>
            </form>
            <div class="text">
                <p>Belum mempunyai akun untuk masuk? <a href="../registrasi/registrasi.php">Registrasi</a></p>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
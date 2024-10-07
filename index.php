
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perpustakaan Online</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg fixed-top">
      <div class="container-fluid d-flex justify-content-center">
        <a class="navbar-brand me-auto" href="#">
          <img src="assets/Buku.png" alt="" width="40" height="40">
        </a>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                <a class="nav-link mx-lg-2 active" aria-current="page" href="#homesection">Beranda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="#aboutsection">Tentang</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="#contactsection">Kontak</a>
              </li>
            </ul>
          </div>
        </div>
        <a href="login/login.php" class="login-button">Masuk</a>
        <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>
  </header>

  <body>
    <section class="first-section" id="homesection">
      <div class="container d-flex align-items-center justify-content-center fs-1 text-white flex-column">
        <h1>Selamat Datang!</h1>
        <h2>Website Perpustakaan Digital</h2>
      </div>
    </section>
    <section class="second-section" id="aboutsection">
      <div class="container d-flex align-items-right justify-content-center fs-1 text-black flex-column">
        <h2>Tentang</h2>
        <p></p>
        <p>Kami dengan bangga mempersembahkan aplikasi perpustakaan yang dibuat khusus untuk memenuhi kebutuhan dan kemauan para pengguna. Kami percaya bahwa akses yang mudah dan nyaman terhadap bahan bacaan adalah hak bagi semua orang, dan kami berkomitmen untuk memberikan layanan terbaik kepada masyarakat kami.</p>
        <p>Aplikasi Perpustakaan dirancang dengan memperhatikan kebutuhan lokal, serta mempertimbangkan kemajuan teknologi. Dengan fitur-fitur yang mudah digunakan dan intuitif, kami ingin memastikan bahwa setiap pengguna dapat menikmati pengalaman membaca yang menyenangkan dan bermanfaat.</p>
        <p>Aplikasi Perpustakaan adalah wujud dari komitmen kami untuk menyediakan layanan perpustakaan yang inklusif, inovatif, dan berorientasi pada kebutuhan pengguna. Kami berharap aplikasi ini dapat menjadi sarana yang bermanfaat bagi seluruh masyarakat dalam mengeksplorasi dunia pengetahuan melalui bacaan. Terima kasih atas dukungan dan partisipasi Anda!</p>
      </div>
    </section>
    <section class="third-section" id="contactsection">
      <div class="container d-flex text-center align-items-center justify-content-center fs-1 text-black flex-column">
        <h2>Kontak</h2>
        <div class="row">
          <div class="col-md-4">
            <p></p>
            <p>Azri Harniza</p>
            <p>azri.22@mhs.usk.ac.id</p>
            <hr>
            <a href="https://wa.me/6282276780995">
              <img src="assets/whatsapp.svg" alt="WhatsApp" width="40" height="40">
            </a>
          </div>
        </div>
      </div>
    </section>
  </body>
  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
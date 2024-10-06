<?php
session_start();
require_once "../../koneksi.php";

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../../login/login.php"); // Redirect to login page if not logged in
    exit();
}

$userID = $_SESSION['id']; // Get user ID from session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>

<body>
    <section class="first-section d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="back-button">
            <a href="../">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="input-box text-center">
            <?php
            $data = mysqli_query($connect, "SELECT * FROM user WHERE id='$userID'");
            if ($row = mysqli_fetch_array($data)) {
                $profilePicture = $row['image']; // Column for profile pictures
                $defaultPicture = "../../assets/Default_Profile.png"; // Path to a default profile picture
            ?>
                <p></p>
                <form action="proses-edit-profil.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="profile-picture-container">
                        <label for="profile-picture">
                            <img src="<?php echo $profilePicture ? '../../uploaded_img/' . $profilePicture : $defaultPicture; ?>" alt="Profile Picture" class="profile-picture" id="profile-img">
                            <input type="file" name="profile_picture" id="profile-picture" class="file-input">
                            <div class="upload-icon">
                                <i class="fas fa-camera"></i>
                            </div>
                        </label>
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping">
                            <img src="../../assets/profile.svg" alt="">
                        </span>
                        <input class="form-control" placeholder="Nama Lengkap" type="text" aria-label="Nama Lengkap" aria-describedby="addon-wrapping" name="nama_lengkap" value="<?php echo $row['nama_lengkap']; ?>">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping">
                            <img src="../../assets/alamat.svg" alt="">
                        </span>
                        <input class="form-control" placeholder="Alamat" type="text" aria-label="Alamat" aria-describedby="addon-wrapping" name="alamat" value="<?php echo $row['alamat']; ?>">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping">
                            <img src="../../assets/telepon.svg" alt="">
                        </span>
                        <input class="form-control" placeholder="Nomor Telepon" type="varchar" aria-label="Telepon" aria-describedby="addon-wrapping" name="telepon" value="<?php echo $row['telepon']; ?>">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping">
                            <img src="../../assets/email.svg" alt="">
                        </span>
                        <input class="form-control" placeholder="Email" type="varchar" aria-label="Email" aria-describedby="addon-wrapping" name="email" value="<?php echo $row['email']; ?>">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping">
                            <img src="../../assets/profile.svg" alt="">
                        </span>
                        <input class="form-control" placeholder="Username" type="text" aria-label="Username" aria-describedby="addon-wrapping" name="username" value="<?php echo $row['username']; ?>">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping">
                            <img src="../../assets/password.svg" alt="">
                        </span>
                        <input class="form-control" placeholder="Password" type="password" aria-label="Password" aria-describedby="addon-wrapping" name="password" value="<?php echo $row['password']; ?>">
                    </div>
                    <p></p>
                    <div class="input-group flex-nowrap mb-3">
                        <button type="submit" name="submit" value="Ubah Data" class="login-button">Ubah Data</button>
                    </div>
                </form>
        </div>
    <?php
            } else {
                echo "<p>User not found.</p>";
            }
    ?>
    </section>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
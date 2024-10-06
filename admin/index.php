<?php
session_start();
include "../koneksi.php";

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../login/login.php"); // Redirect to login page if not logged in
    exit();
}

$userID = $_SESSION['id'];
$query = "SELECT nama_lengkap, image FROM user WHERE id='$userID'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

$nama_lengkap = $row['nama_lengkap'];
$profilePicture = !empty($row['image']) ? "../uploaded_img/" . $row['image'] : "../assets/Default_Profile.png";

// Fetch user counts by month and authority
$monthQuery = "
    SELECT DATE_FORMAT(created_at, '%M/%Y') as month, otoritas, COUNT(*) as count 
    FROM user 
    GROUP BY month, otoritas
";
$monthResult = mysqli_query($connect, $monthQuery);
$monthlyData = [];
while ($row = mysqli_fetch_assoc($monthResult)) {
    $monthlyData[] = $row;
}

// Fetch distinct years for dropdown
$distinctYearsQuery = "
    SELECT DISTINCT DATE_FORMAT(created_at, '%Y') as year
    FROM user
    ORDER BY year
";
$distinctYearsResult = mysqli_query($connect, $distinctYearsQuery);
$years = [];
while ($row = mysqli_fetch_assoc($distinctYearsResult)) {
    $years[] = $row['year'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container-fluid d-flex justify-content-center">
                <a class="navbar-brand me-auto" href="profile/index.php">
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
                                <a class="nav-link mx-lg-2 active" aria-current="page" href="#">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-lg-2" href="user/index.php">Data Pengguna</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-lg-2" href="buku/index.php">Data Buku</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <form action="../logout/logout.php" method="post">
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
                <div class="d-flex">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonYear" data-bs-toggle="dropdown" aria-expanded="false">
                            Pilih Tahun
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonYear">
                            <?php foreach ($years as $year) : ?>
                                <a href="#" id="<?php echo $year; ?>" class="dropdown-item year-item"><?php echo $year; ?></a>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                    <canvas id="userChart" style="max-height: 500px;"></canvas>
            </div>
        </div>
    </section>

    <script>
    const monthlyData = <?php echo json_encode($monthlyData); ?>;
    const distinctYears = <?php echo json_encode($years); ?>;

    function filterDataByYear(data, year) {
        return data.filter(item => item.month.startsWith(year));
    }

    function formatData(data) {
        const admins = data.filter(item => item.otoritas === 'ADMIN');
        const members = data.filter(item => item.otoritas === 'MEMBER');
        const labels = [...new Set(data.map(item => item.month))];

        return {
            labels: labels,
            datasets: [{
                    label: 'Admin',
                    data: labels.map(l => (admins.find(a => a.month === l) || {}).count || 0),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Member',
                    data: labels.map(l => (members.find(m => m.month === l) || {}).count || 0),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }
            ]
        };
    }

    var ctx = document.getElementById('userChart').getContext('2d');
    var userChart = new Chart(ctx, {
        type: 'bar',
        data: formatData(monthlyData),
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function updateChart(chart, data) {
        chart.data = formatData(data);
        chart.update();
    }

    document.querySelectorAll('.year-item').forEach(item => {
        item.addEventListener('click', event => {
            const year = event.target.textContent;

            // Update the dropdown button text
            document.getElementById('dropdownMenuButtonYear').innerText = `Tahun ${year}`;

            // Update the dropdown button color
            document.getElementById('dropdownMenuButtonYear').classList.remove('btn-secondary');
            document.getElementById('dropdownMenuButtonYear').classList.add('btn-success');
        });
    });
</script>
</body>

</html>
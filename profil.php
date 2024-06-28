<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data dan Statistik</title>
    <link rel="stylesheet" href="CSS/profil.css">
</head>
<body>
    <!-- Navbar -->
    <header>
    <nav class="navbar">
            <div class="logo">
                <img src="img/logo.png" alt="Logo" />
            </div>
            <ul class="menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="pilihanMatkul.php">Mata Kuliah</a></li>
                <li><a href="paring.php">Papan Peringkat</a></li>
                <li><a href="aboutUs.php">Tentang Kami</a></li>
                <li>
                    <?php
                    // Menampilkan nama pengguna jika ada yang masuk
                    if (isset($_SESSION["username"])) {
                        $username = $_SESSION["username"];
                        echo "Hi! $username";
                    } else {
                        echo "Hi!";
                    }
                    ?>
                </li>
                <li><a href="profil.php"><img src="img/avatar.png" alt="User" class="user-icon"></a></li>
                <!-- <li></li> -->
            </ul>
            <div class="menu-toggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </nav>
    </header>
    <!-- End -->
    <div class="container">
        <div class="sidebar">
            <div class="user-profile">
                <img src="img/avatar.png" alt="User Profile">
                <h2>user</h2>
                <p>ID: 8797524</p>
                <p>Username: Valesku2up</p>
                <p>Password: *********</p>
                <button>Log Out</button>
            </div>
        </div>
        <div class="main-content">
            <h1>Data dan Statistik</h1>
            <div class="chart-container">
                <div class="chart" id="pie-chart">
                    <!-- Pie chart will be inserted here -->
                </div>
            </div>
            <div class="chart-container">
                <div class="chart" id="bar-chart">
                    <!-- Bar chart will be inserted here -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>

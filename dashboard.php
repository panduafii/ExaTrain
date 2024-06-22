<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="CSS/dashboard.css" />
</head>

<body style="background-image: url('img/wave.png'); background-repeat: no-repeat; background-size: cover;">
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="img/logo.png" alt="Logo" />
        </div>
        <ul class="menu">
            <li><a href="landingPage.php">Beranda</a></li>
            <li><a href="pilihanMatkul.php">Mata Kuliah</a></li>
            <li><a href="paring.php">Papan Peringkat</a></li>
            <li><a href="#">Tentang Kami</a></li>
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
                <a href="profil.php"><img src="img/avatar.png" alt="user" /></a>
            </li>
        </ul>
    </nav>
    <!-- End Navbar -->

    <!-- Content -->
    <main>
        <h1>Dashboard</h1>
        <div class="dashboard">
            <a href="pilihanMatkul.php" class="card-link">
                <div class="card">
                    <img src="img/icon matkul.png" alt="Mata Kuliah" />
                    <p>Mata Kuliah</p>
                </div>
            </a>
            <a href="paring.php" class="card-link">
                <div class="card">
                    <img src="img/icon paring.png" alt="Papan Peringkat" />
                    <p>Papan Peringkat</p>
                </div>
            </a>
            <a href="pembayaran.php" class="card-link">
                <div class="card">
                    <img src="img/icon payment.png" alt="Pembayaran" />
                    <p>Pembayaran</p>
                </div>
            </a>
        </div>
    </main>
</body>
</html>

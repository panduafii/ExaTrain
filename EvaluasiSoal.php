<?php
// Memulai sesi
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika tidak ada sesi username, arahkan pengguna kembali ke halaman login
    header("Location: loginRegist.php");
    exit; // Pastikan tidak ada kode ekstra yang dijalankan setelah pengalihan header
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Soal & Evaluasi</title>
    <link rel="stylesheet" href="CSS/menu.css" />
</head>
<body>
    <!-- NAVBAR -->
    <header>
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
                    <a href="profil.php"><img src="img/avatar.png" alt="User" class="user-icon"></a>
                </li>
                <!-- <li></li> -->
            </ul>
            <div class="menu-toggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </nav>
    </header>

    <!-- Tombol Back -->
    <div class="back-button" onclick="goBack()">
      <a href="#">&larr;</a>
    </div>
    <!-- End -->

    <!-- MENU -->
    <div class="container">
      <h1>Soal & Evaluasi</h1>
      <div class="content">
        <div class="card" onclick="location.href='lihatJawaban.php'">
          <img src="img/checklist.png" alt="Evaluasi" />
          <p>Evaluasi</p>
        </div>
        <div class="card" onclick="redirectToIndex()">
          <img src="img/pencil.png" alt="Soal" />
          <p>Soal</p>
        </div>
    </div>
    <!-- JavaScript untuk mengarahkan ke halaman index.php -->
    <script>
        function goBack() {
            window.history.back();
        }

        function redirectToIndex() {
            window.location.href = 'index.php';
        }
    </script>
  </body>
</html>

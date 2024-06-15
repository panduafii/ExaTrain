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
    <title>Pilihan Mata Kuliah</title>
    <link rel="stylesheet" href="CSS/pilihanMatkul.css" />
  </head>
  <body style="background-image: url('img/background.png'); width: 100%;">
    <!-- Navbar -->
    <header>
      <nav class="navbar">
        <div class="logo">
          <img src="img/logo.png" alt="Logo" />
        </div>
        <ul class="menu">
          <li><a href="#">Beranda</a></li>
          <li><a href="#">Mata Kuliah</a></li>
          <li><a href="#">Papan Peringkat</a></li>
          <li><a href="#">Tentang Kami</a></li>
          <li><a href="#"><img src="img/avatar.png" alt="User" class="user-icon"></a></li>
        </ul>
      </nav>
    </header>
    <!-- End Navbar -->

    <!-- Tombol Back -->
    <div class="back-button" onclick="goBack()">
      <a href="#">&larr;</a>
    </div>
    <!-- End -->

    <!-- Pilihan Matkul -->
    <div class="container">
      <button class="back-button" onclick="goBack()">&#8592;</button>
      <h1>Pilihan Mata Kuliah</h1>
      <div class="year-buttons">
        <button id="2023" class="year-button">2023</button>
        <button id="2022" class="year-button active">2022</button>
        <button id="2021" class="year-button">2021</button>
      </div>
      <div class="courses">
        <button class="course-button" onclick="selectCourse('Pengembangan Sistem Informasi')">
          <img src="img/psi.png" alt="Pengembangan Sistem Informasi" />
          <span>Pengembangan Sistem Informasi</span>
        </button>
        <button class="course-button" onclick="selectCourse('Grafika dan Multimedia')">
          <img src="img/grafmul.png" alt="Grafika dan Multimedia" />
          <span>Grafika dan Multimedia</span>
        </button>
        <button class="course-button" onclick="selectCourse('Sistem Cerdas dan Pendukung Keputusan')">
          <img src="img/scpk.png" alt="Sistem Cerdas dan Pendukung Keputusan" />
          <span>Sistem Cerdas dan Pendukung Keputusan</span>
        </button>
      </div>

      <div class="courses">
      <button class="course-button" onclick="selectCourse('Bahasa Indonesia Komunikasi Ilmiah')">
        <img src="img/bindo.png" alt="Bahasa Indonesia Komunikasi Ilmiah" />
        <span>Bahasa Indonesia Komunikasi Ilmiah</span>
      </button>
      <button class="course-button" onclick="selectCourse('Bahasa Inggris Teknologi Informasi')">
        <img src="img/bingris.png" alt="Bahasa Inggris Teknologi Informasi" />
        <span>Bahasa Inggris Teknologi Informasi</span>
      </button>
      <button class="course-button" onclick="selectCourse('Islam Ulil Albab')">
        <img src="img/islam.png" alt="Islam Ulil Albab" />
        <span>Islam Ulil Albab</span>
      </button>
     </div>
    <script>
      function goBack() {
        window.history.back();
      }

      function selectCourse(courseName) {
        alert('You have selected: ' + courseName);
      }
    </script>
  </body>
</html>

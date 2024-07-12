<?php
session_start();
// Koneksi ke database
include 'fungsiPHP/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="CSS/aboutUs.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="img/logo.png" alt="Exatrain Logo" />
        </div>
        <ul class="menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="pilihanMatkul.php">Mata Kuliah</a></li>
                <li><a href="paring.php">Papan Peringkat</a></li>
                <li><a href="aboutUs.php">Tentang Kami</a></li>
                <li><?php
                    // Menampilkan nama pengguna jika ada yang masuk
                    if (isset($_SESSION["username"])) {
                        $username = $_SESSION["username"];
                        echo "Hi! $username";
                    } else {
                        echo "Hi!";
                    }
                    ?></li>
                <li><a href="profil.php"><img src="img/avatar.png" alt="User" class="user-icon"></a></li>
            </ul>
    </nav>
    <header class="header">
        <h1>About Us</h1>
        <img src="img/picture1.png" alt="Background Header Image">
    </header>

    <section class="project">
        <div class="project-content">
            <h2>Our Project</h2>
            <p>Projek ini mengambil tema pendidikan, berkaca pada negara Barat, kami memfokuskan pembuatan soal essay untuk dapat melatih logika mahasiswa. Tidak hanya itu, soal essay juga dapat melatih mahasiswa untuk dapat berpikir kritis dan belajar memahami materi dengan baik, tidak hanya berfokus pada hafalan saja.</p>
            <p>Hal inilah yang membuat kami untuk memilih sistem AI sebagai parameter jawaban, dimana AI bekerja untuk menilai dan memberikan evaluasi bagi jawaban mahasiswa dan membandingkannya dengan kunci jawaban.</p>
        </div>
        <div class="project-image">
            <img src="img/work.jpeg" alt="Project Image">
        </div>
    </section>

    <section class="services">
        <h2>Our Services</h2>
        <div class="services-container">
            <div class="service">
                <img src="img/exam.png" alt="Try Out Icon">
                <h3>TRY OUT</h3>
                <p>Mengerjakan soal try out dengan essay</p>
            </div>
            <div class="service">
                <img src="img/ai.png" alt="Try Out Icon">
                <h3>AI CHECK</h3>
                <p>Pengecekan jawaban menggunakan AI</p>
            </div>
            <div class="service">
                <img src="img/detail.png" alt="Try Out Icon">
                <h3>DETAIL</h3>
                <p>Kunci jawaban akan diberikan penjelasan mendetail</p>
            </div>
            <div class="service">
                <img src="img/ranking.png" alt="Try Out Icon">
                <h3>RANKING</h3>
                <p>Melihat ranking dengan skor yang didapat</p>
            </div>
            <div class="service">
                <img src="img/progress.png" alt="Try Out Icon">
                <h3>PROGRESS</h3>
                <p>Dapat mengetahui progres sejauh mana memahami materi dengan grafik</p>
            </div>
        </div>
    </section>

    <section class="team">
        <h2>Meet Our Team</h2>
        <div class="team-container">
            <div class="team-member">
                <img src="img/man.png" alt="Team Member 1">
                <h3>Pandu Nur Afi</h3>
            </div>
            <div class="team-member">
                <img src="img/man.png" alt="Team Member 2">
                <h3>Lutfi Surya Pradana</h3>
            </div>
            <div class="team-member">
                <img src="img/man.png" alt="Team Member 3">
                <h3>M. Khalil Halabi</h3>
            </div>
            <div class="team-member">
                <img src="img/woman.png" alt="Team Member 4">
                <h3>Alifah Kusuma Ramadhini</h3>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <!-- <div class="footer-section">
                <img src="img/logo1.png" alt="">
            </div> -->
            <div class="footer-section">
                <h3>Arbaach Team</h3>
            </div>
    </footer>
</body>
</html>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selected_course_id'])) {
    $selectedCourseId = $_POST['selected_course_id'];

    // Simpan selected_course_id di dalam session
    $_SESSION['selected_course_id'] = $selectedCourseId;

    // Redirect ke halaman index.php
    header('Location: EvaluasiSoal.php');
    exit();
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
<body style="background-image: url('img/background.png'); background-size: cover; background-repeat: no-repeat;">
    <!-- Navbar -->
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
                </li>
                <li><a href="profil.php"><img src="img/avatar.png" alt="User" class="user-icon"></a></li>
            </ul>
            <div class="menu-toggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
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
        <strong><h1>Pilihan Mata Kuliah</h1></strong>
        <div class="year-buttons">
            <button id="2023" class="year-button">2023</button>
            <button id="2022" class="year-button active">2022</button>
            <button id="2021" class="year-button">2021</button>
        </div>
        <div class="courses">
            <form action="pilihanMatkul.php" method="post" id="courseForm">
                <!-- Course wrapper for each year -->
                <div class="course-wrapper" id="course-2023" style="display: none;">
                    <!-- Courses for 2023 will be injected here by JavaScript -->
                </div>
                <div class="course-wrapper" id="course-2022">
                    <!-- Courses for 2022 will be injected here by JavaScript -->
                </div>
                <div class="course-wrapper" id="course-2021" style="display: none;">
                    <!-- Courses for 2021 will be injected here by JavaScript -->
                </div>
            </form>
        </div>
    </div>

    <script src="JS/pilihanMatkul.js"></script>
    <script>
        function goBack() {
            window.history.back("dashboard.php");
        }
      function goBack() {
        window.history.back("dashboard.php");
      }
    </script>
</body>
</html>
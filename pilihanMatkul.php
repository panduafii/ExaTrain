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
<<<<<<< HEAD
<body style="background-image: url('img/background.png'); width: 100%;">
=======
<body style="background-image: url('img/background.png'); background-size: cover; background-repeat: no-repeat;">
>>>>>>> c519bfb8c1dadc9e29e1b513f1a2a7c641e6838c
    <!-- Navbar -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="img/logo.png" alt="Logo" />
            </div>
            <ul class="menu">
<<<<<<< HEAD
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Mata Kuliah</a></li>
                <li><a href="#">Papan Peringkat</a></li>
=======
                <li><a href="landingPage.php">Beranda</a></li>
                <li><a href="pilihanMatkul.php">Mata Kuliah</a></li>
                <li><a href="paring.php">Papan Peringkat</a></li>
>>>>>>> c519bfb8c1dadc9e29e1b513f1a2a7c641e6838c
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
<<<<<<< HEAD
                </li>
                <li><a href="#"><img src="img/avatar.png" alt="User" class="user-icon"></a></li>
            </ul>
=======
                    <a href="profil.php"><img src="img/avatar.png" alt="User" class="user-icon"></a>
                </li>
                <!-- <li></li> -->
            </ul>
            <div class="menu-toggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
>>>>>>> c519bfb8c1dadc9e29e1b513f1a2a7c641e6838c
        </nav>
    </header>
    <!-- End Navbar -->

<<<<<<< HEAD

    <!-- Pilihan Matkul -->
    <div class="container">
        <h1>Pilihan Mata Kuliah</h1>
        <div class="year-buttons">
            <button id="2023" class="year-button">2023</button>
            <button id="2022" class="year-button active">2022</button>
            <button id="2021" class="year-button">2021</button>
        </div>
        <div class="courses">
            <form action="pilihanMatkul.php" method="post" id="courseForm">
                <button class="course-button" name="selected_course_id" value="1">
                    <img src="img/psi.png" alt="Pengembangan Sistem Informasi" />
                    <span>Pengembangan Sistem Informasi</span>
                </button>
                <button class="course-button" name="selected_course_id" value="2">
                    <img src="img/grafmul.png" alt="Grafika dan Multimedia" />
                    <span>Grafika dan Multimedia</span>
                </button>
                <button class="course-button" name="selected_course_id" value="3">
                    <img src="img/scpk.png" alt="Sistem Cerdas dan Pendukung Keputusan" />
                    <span>Sistem Cerdas dan Pendukung Keputusan</span>
                </button>
                <button class="course-button" name="selected_course_id" value="4">
                    <img src="img/bindo.png" alt="Bahasa Indonesia Komunikasi Ilmiah" />
                    <span>Bahasa Indonesia Komunikasi Ilmiah</span>
                </button>
                <button class="course-button" name="selected_course_id" value="5">
                    <img src="img/bingris.png" alt="Bahasa Inggris Teknologi Informasi" />
                    <span>Bahasa Inggris Teknologi Informasi</span>
                </button>
                <button class="course-button" name="selected_course_id" value="6">
                    <img src="img/islam.png" alt="Islam Ulil Albab" />
                    <span>Islam Ulil Albab</span>
                </button>
            </form>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back("dashboard.php");
        }
    </script>
</body>
</html>
=======
     <!-- Tombol Back -->
     <div class="back-button" onclick="goBack()">
      <a href="#">&larr;</a>
    </div>
    <!-- End -->

    <!-- Pilihan Matkul -->
    <div class="container">
    <strong><h1>Pilihan Mata Kuliah</h1></strong>
        <div class="year-buttons">
          <button id="2021" class="year-button">2021</button>
            <button id="2022" class="year-button active">2022</button>
            <button id="2023" class="year-button">2023</button>
           
        </div>
       
        <form action="pilihanMatkul.php" method="post" id="courseForm">
            <div class="courses">
            <script src="JS/pilihanMatkul.js"></script>
            </div>
        </form>
    </div>
    <!-- End -->
   
    <!-- Back Button -->
    <script>
      function goBack() {
        window.history.back("dashboard.php");
      }
    </script>
</body>
</html>
>>>>>>> c519bfb8c1dadc9e29e1b513f1a2a7c641e6838c

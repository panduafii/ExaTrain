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
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Mata Kuliah</a></li>
                <li><a href="#">Papan Peringkat</a></li>
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
                <li><a href="#"><img src="img/avatar.png" alt="User" class="user-icon"></a></li>
            </ul>
        </nav>
    </header>
    <!-- End Navbar -->


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
   

    <script>
        function goBack() {
            window.history.back("dashboard.php");
        }
    </script>
</body>
</html>
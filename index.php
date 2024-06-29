<?php
// Memulai sesi
session_start();

$subject_id = $_SESSION['selected_course_id'];

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ExaTrain";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Mengambil nama subject
$subjectQuery = "SELECT subject_name FROM subject WHERE id = " . $subject_id;
$subjectResult = $conn->query($subjectQuery);
if ($subjectResult->num_rows > 0) {
    $subjectRow = $subjectResult->fetch_assoc();
    $subject_name = $subjectRow['subject_name'];
} else {
    $subject_name = "Nama Mata Kuliah Tidak Ditemukan";
}


// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika tidak ada sesi username, arahkan pengguna kembali ke halaman login
    header("Location: loginRegist.php");
    exit; // Pastikan tidak ada kode ekstra yang dijalankan setelah pengalihan header
}

// Memeriksa apakah user_id ada dalam sesi
if (!isset($_SESSION['user_id'])) {
    // Jika tidak ada user_id dalam sesi, arahkan pengguna kembali ke halaman login
    header("Location: loginRegist.php");
    exit;
}

// Memeriksa apakah selected_course_id ada dalam sesi
if (!isset($_SESSION['selected_course_id'])) {
    // Jika tidak ada selected_course_id dalam sesi, arahkan pengguna ke halaman pemilihan mata kuliah
    header("Location: pilihMatkul.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="CSS/quizPage.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
      <div class="logo">
        <img src="img/logo.png" alt="Logo" />
      </div>
      <ul class="menu">
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
    </nav>
    <!-- End Navbar -->

    <h1>Quiz</h1>
    <div class="title">
                <h1><?php echo $subject_name; ?></h1>
    </div>


    <!-- Menyertakan file quizPage.php -->
    <?php include "fungsiPHP/quizPage.php"; ?>

</body>
</html>

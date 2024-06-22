<?php
// Memulai sesi
session_start();

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
    <h1>Quiz</h1>

    <div class="user-info">
        <?php
        // Menampilkan nama pengguna jika ada yang masuk
        if (isset($_SESSION["username"])) {
            $username = $_SESSION["username"];
            echo "Hi!, $username!";
        } else {
            echo "Hi!";
        }
        ?>
    </div>

    <!-- Menyertakan file quizPage.php -->
    <?php include "fungsiPHP/quizPage.php"; ?>

</body>
</html>

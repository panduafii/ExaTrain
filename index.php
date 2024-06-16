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
        session_start();
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

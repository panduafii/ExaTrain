<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="CSS/quizPage.css">
    <style>
        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        .question-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .question-buttons button {
            margin-right: 5px;
            background-color: white; /* Warna default putih */
            color: black; /* Warna teks hitam */
            border: 1px solid #ccc; /* Border warna abu-abu muda */
            padding: 10px 15px; /* Padding untuk tombol */
            cursor: pointer; /* Mengubah kursor saat mouse berada di atas tombol */
        }
        .question-buttons button.answered {
            background-color: lightblue; /* Warna biru muda jika sudah dijawab */
        }
        .form-footer {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .user-info {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Quiz</h1>

    <div class="user-info">
        <?php
        session_start();
        // Menampilkan nama pengguna jika ada yang masuk
        if (isset($_SESSION["username"])) {
            $username = $_SESSION["username"];
            echo "Selamat datang, $username!";
        } else {
            echo "Selamat datang!";
        }
        ?>
    </div>

    <a href="addUser.php">Tambah Pengguna Baru</a>

    <form action="" method="post">
        <?php
        // Koneksi ke database
        $servername = "localhost";
        $username = "root"; // Ganti dengan username Anda
        $password = "root"; // Ganti dengan password Anda
        $dbname = "ExaTrain";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Koneksi ke database gagal: " . $conn->connect_error);
        }

        // Menyimpan jawaban sebelumnya
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['essay_answer'])) {
                $currentQuestion = $_POST['current_question'];
                $_SESSION['answers'][$currentQuestion] = $_POST['essay_answer'];
            }

            // Logika untuk submit jawaban akhir
            if (isset($_POST['submit_final'])) {
                // Proses penyimpanan jawaban akhir
                foreach ($_SESSION['answers'] as $questionId => $answer) {
                    // Contoh query penyimpanan (sesuaikan dengan struktur tabel Anda)
                    $sql = "INSERT INTO answers (user_id, question_id, answer) VALUES ('1', '$questionId', '$answer') ON DUPLICATE KEY UPDATE answer='$answer'";
                    $conn->query($sql);
                }

                // Hapus jawaban dari sesi setelah disimpan
                unset($_SESSION['answers']);
                echo "Jawaban Anda telah disimpan.";
            }
        }

        // Menentukan pertanyaan saat ini
        $questionId = isset($_POST['question_id']) ? (int)$_POST['question_id'] : 1;

        // Ambil pertanyaan dari database
        $sql = "SELECT * FROM questions WHERE id = $questionId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Menampilkan pertanyaan
            $row = $result->fetch_assoc();
            echo "<h2>" . $row['question_text'] . "</h2>";

            // Menampilkan textarea untuk jawaban essay
            $answer = isset($_SESSION['answers'][$questionId]) ? $_SESSION['answers'][$questionId] : '';
            echo "<textarea name='essay_answer'>$answer</textarea>";
        } else {
            echo "Pertanyaan tidak ditemukan.";
        }

        $conn->close();
        ?>
        <input type="hidden" name="current_question" value="<?php echo $questionId; ?>">
        <!-- Tombol untuk soal nomor 1 hingga 10 dan tombol submit -->
        <div class="form-footer">
            <div class="question-buttons">
                <?php
                for ($i = 1; $i <= 10; $i++) {
                    // Cek apakah pertanyaan ini sudah dijawab
                    $buttonClass = isset($_SESSION['answers'][$i]) && !empty($_SESSION['answers'][$i]) ? 'answered' : '';
                    echo "<button type='submit' name='question_id' value='$i' class='$buttonClass'>Soal $i</button>";
                }
                ?>
            </div>
            <!-- Tombol untuk mengirim jawaban -->
            <button type='submit' name='submit_final'>Submit Jawaban</button>
        </div>
    </form>
</body>
</html>

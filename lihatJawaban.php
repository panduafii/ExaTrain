<?php
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

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ExaTrain";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil ID pengguna dan ID mata kuliah dari session
$user_id = $_SESSION['user_id'];
$subject_id = $_SESSION['selected_course_id'];

// Query untuk mengambil soal dan jawaban
$sql = "SELECT q.id, q.question_text, q.correct_answer, a.answer, a.is_correct, a.evaluasi_ai 
        FROM questions q 
        LEFT JOIN answers a ON q.id = a.question_id AND a.user_id = '$user_id'
        WHERE q.subject_id = '$subject_id'";

$result = $conn->query($sql);
$questions = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
} else {
    echo "0 results";
}

// Query untuk mengambil nama mata kuliah
$course_sql = "SELECT subject_name FROM subject WHERE id = '$subject_id'";
$course_result = $conn->query($course_sql);
$course_name = "";
if ($course_result->num_rows > 0) {
    $course_row = $course_result->fetch_assoc();
    $course_name = $course_row['subject_name'];
} else {
    echo "Nama mata kuliah tidak ditemukan.";
}


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Soal & Evaluasi</title>
    <link rel="stylesheet" href="CSS/lihatEval.css" />
</head>
<body>
    <!-- NAVBAR -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="img/logo.png" alt="Logo" />
            </div>
            <div>
                <?php
                    $selectedCourseId = $_SESSION['selected_course_id'];
                    $userId = $_SESSION['user_id'];
                    // echo "=====" . $selectedCourseId;
                    // echo "=====" . $userId;
                ?>
            </div>
            <ul class="menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="pilihanMatkul.php">Mata Kuliah</a></li>
                <li><a href="paring.php">Papan Peringkat</a></li>
                <li><a href="aboutUs.php">Tentang Kami</a></li>
                <li>Hi! <?= isset($_SESSION["username"]) ? $_SESSION["username"] : "Guest"; ?></li>
                <li><a href="profil.php"><img src="img/avatar.png" alt="User" class="user-icon"></a></li>
            </ul>

        </nav>
    </header>

    <!-- Tombol Back -->
    <div class="back-button" onclick="goBack()">
      <a href="#">&larr;</a>
    </div>
    <!-- MENU -->
    <main>
        <div class="question-container">
            <div>
            <h3><?= htmlspecialchars($course_name) ?></h3>
            </div>
            <?php foreach ($questions as $index => $question): ?>
                
                <div class="question-block" id="question-<?= $index ?>" style="display: <?= $index === 0 ? 'block' : 'none'; ?>">
                    <h4>Soal</h4>
                    <p><?= $question['question_text'] ?></p>
                    
                    <h4>Jawaban Anda</h4>
                    <p><?= $question['answer'] ?></p>
                    

                    <div class="evaluation-box">
                        <div>
                    <strong>Kunci Jawaban:</strong> 
                    <p><?= $question['correct_answer'] ?></p>
                    </div>
                    </div>

                    <div class="answer-box">
                    <strong>Evaluasi AI:</strong>
                    <p> <?= $question['evaluasi_ai'] ?></p>
                    </div>    
                </div>
            <?php endforeach; ?>
            <div class="question-navigation">
                <?php foreach ($questions as $index => $question): ?>
                    <button onclick="showQuestion(<?= $index ?>)" style="background-color: <?= $question['is_correct'] ? 'green' : 'red'; ?>;">
                        <?= $index + 1 ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <script>
        function showQuestion(index) {
            const allQuestions = document.querySelectorAll('.question-block');
            const buttons = document.querySelectorAll('.question-navigation button');

            // Sembunyikan semua pertanyaan dan hapus kelas aktif dari semua tombol
            allQuestions.forEach((el, idx) => {
                el.style.display = 'none';
                buttons[idx].classList.remove('active');
            });

            // Tampilkan pertanyaan yang dipilih dan tambahkan kelas aktif pada tombol yang bersangkutan
            document.getElementById('question-' + index).style.display = 'block';
            buttons[index].classList.add('active');
        }

    </script>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
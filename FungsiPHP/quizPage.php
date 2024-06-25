<?php
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ExaTrain";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Menyimpan jawaban sebelumnya jika ada
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['essay_answer'])) {
        $currentQuestion = $_POST['current_question'];
        $_SESSION['answers'][$currentQuestion] = $_POST['essay_answer'];
    }

    // Logika untuk submit jawaban akhir
    if (isset($_POST['submit_final'])) {
        // Pastikan user_id dan subject_id ada dalam sesi
        if (isset($_SESSION['user_id']) && isset($_SESSION['selected_course_id'])) {
            $userId = $_SESSION['user_id'];
            $selectedCourseId = $_SESSION['selected_course_id'];

            foreach ($_SESSION['answers'] as $questionId => $answer) {
                $userId = $_SESSION['user_id'];
                $selectedCourseId = $_SESSION['selected_course_id'];
                // Simpan jawaban ke dalam tabel answers
                $sql = "INSERT INTO answers (user_id, subject_id, question_id, answer) VALUES ('$userId', '$selectedCourseId', '$questionId', '$answer') ON DUPLICATE KEY UPDATE answer='$answer'";

                if ($conn->query($sql) === FALSE) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // Hapus jawaban dari sesi setelah disimpan
            unset($_SESSION['answers']);

            // Redirect ke halaman pilihanMatkul.php setelah submit jawaban
            header("Location: pilihanMatkul.php");
            exit; // Pastikan tidak ada output HTML setelah header redirect
        } else {
            echo "User ID atau Subject ID tidak ditemukan.";
        }
    }
}


// Tentukan selected_course_id dari session
if (isset($_SESSION['selected_course_id']) && isset($_SESSION['user_id'])) {

    $selectedCourseId = $_SESSION['selected_course_id'];
    $userId = $_SESSION['user_id'];
    echo "=====" . $selectedCourseId;
    echo "=====" . $userId;

    // Query untuk menghitung jumlah soal berdasarkan selected_course_id
    $sql_count_questions = "SELECT COUNT(*) AS total_questions FROM questions WHERE subject_id = $selectedCourseId";
    $result_count_questions = $conn->query($sql_count_questions);

    if ($result_count_questions->num_rows > 0) {
        $row_count_questions = $result_count_questions->fetch_assoc();
        $totalQuestions = $row_count_questions['total_questions'];
    } else {
        $totalQuestions = 0;
    }

    // Ambil ID pertanyaan pertama dari matakuliah yang dipilih
    $firstQuestionId = getFirstQuestionId($conn, $selectedCourseId);

    // Menentukan pertanyaan saat ini
    $questionId = isset($_POST['question_id']) ? (int)$_POST['question_id'] : $firstQuestionId;

    // Ambil pertanyaan dari database berdasarkan selected_course_id dan question_id
    $sql = "SELECT * FROM questions WHERE subject_id = $selectedCourseId AND id = $questionId";
    $result = $conn->query($sql);

    // Periksa apakah ada error dalam query
    if (!$result) {
        die("Error dalam query: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        // Menampilkan pertanyaan dan form jawaban
        $row = $result->fetch_assoc();
        echo "<h2>" . $row['question_text'] . "</h2>";

        // Menampilkan textarea untuk jawaban essay
        $answer = isset($_SESSION['answers'][$questionId]) ? $_SESSION['answers'][$questionId] : '';
        echo "<form action='' method='post'>";
        echo "<textarea name='essay_answer'>$answer</textarea>";

        // Tombol untuk soal nomor 1 hingga jumlah soal untuk mata kuliah yang dipilih
        echo "<input type='hidden' name='current_question' value='$questionId'>";
        echo "<div class='form-footer'>";
        echo "<div class='question-buttons'>";
        for ($i = 1; $i <= $totalQuestions; $i++) {
            // Ambil ID pertanyaan sesuai urutan soal
            $questionIdForButton = getQuestionIdByOrder($conn, $selectedCourseId, $i);

            // Cek apakah pertanyaan ini sudah dijawab
            $buttonClass = isset($_SESSION['answers'][$questionIdForButton]) && !empty($_SESSION['answers'][$questionIdForButton]) ? 'answered' : '';

            echo "<button type='submit' name='question_id' value='$questionIdForButton' class='$buttonClass'>Soal $i</button>";
        }
        echo "</div>";
        // Tombol untuk mengirim jawaban
        echo "<button type='submit' name='submit_final'>Submit Jawaban</button>";
        echo "</div>";
        echo "</form>";

    } else {
        echo "Pertanyaan tidak ditemukan.";
    }
} else {
    echo "Belum ada mata kuliah yang dipilih.";
}

$conn->close();

// Fungsi untuk mendapatkan ID pertanyaan pertama untuk mata kuliah yang dipilih
function getFirstQuestionId($conn, $subjectId) {
    $sql_first_question = "SELECT MIN(id) AS first_question_id FROM questions WHERE subject_id = $subjectId";
    $result_first_question = $conn->query($sql_first_question);

    if ($result_first_question && $result_first_question->num_rows > 0) {
        $row_first_question = $result_first_question->fetch_assoc();
        return $row_first_question['first_question_id'];
    } else {
        return 1; // Jika tidak ada pertanyaan, kembalikan nilai default 1
    }
}

// Fungsi untuk mendapatkan ID pertanyaan berdasarkan urutan soal dalam mata kuliah yang dipilih
function getQuestionIdByOrder($conn, $subjectId, $order) {
    $sql_question_by_order = "SELECT id FROM questions WHERE subject_id = $subjectId ORDER BY id LIMIT " . ($order - 1) . ", 1";
    $result_question_by_order = $conn->query($sql_question_by_order);

    if ($result_question_by_order && $result_question_by_order->num_rows > 0) {
        $row_question_by_order = $result_question_by_order->fetch_assoc();
        return $row_question_by_order['id'];
    } else {
        return 0; // Jika tidak ada pertanyaan, kembalikan nilai 0 (ini tergantung dari kebutuhan aplikasi Anda)
    }
}
?>

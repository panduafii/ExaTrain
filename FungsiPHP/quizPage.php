<?php
session_start();

// Koneksi ke database
include 'connection.php';

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
        echo "<h2 class='tulisanPertanyaan'>Soal</h2>";

        // Cek apakah tombol pertama yang ditekan
        $isFirstQuestion = ($questionId == $firstQuestionId);
        if ($isFirstQuestion) {
            $questionNumber = 1;
        } else {
            // Cari nomor soal berdasarkan ID pertanyaan
            $questionNumber = getQuestionOrderById($conn, $selectedCourseId, $questionId);
        }

        echo "<h4 class='isiPertanyaan'> " . $questionNumber . ". " . $row['question_text'] . "</h4>";

        // Menampilkan textarea untuk jawaban essay
        $answer = isset($_SESSION['answers'][$questionId]) ? $_SESSION['answers'][$questionId] : '';
        echo "<form class='formjawaban' action='' method='post'>";
        echo "<textarea class='isiBox' name='essay_answer'>$answer</textarea>";

        // Tombol untuk soal nomor 1 hingga jumlah soal untuk mata kuliah yang dipilih
        echo "<input type='hidden' name='current_question' value='$questionId'>";
        echo "<div class='form-footer'>";

        // Tombol Previous dan Next
        $prevQuestionId = getPreviousQuestionId($conn, $selectedCourseId, $questionId);
        $nextQuestionId = getNextQuestionId($conn, $selectedCourseId, $questionId);

        if ($prevQuestionId) {
            echo "<button type='submit' name='question_id' value='$prevQuestionId' class='question-button'>ack</button>";
        }
        if ($nextQuestionId) {
            echo "<button type='submit' name='question_id' value='$nextQuestionId' class='question-button'>Next</button>";
        }

        // Tombol untuk soal nomor 1 hingga jumlah soal untuk mata kuliah yang dipilih
        echo "<div class='question-buttons'>";
        for ($i = 1; $i <= $totalQuestions; $i++) {
            // Ambil ID pertanyaan sesuai urutan soal
            $questionIdForButton = getQuestionIdByOrder($conn, $selectedCourseId, $i);

            // Cek apakah pertanyaan ini sudah dijawab
            $buttonClass = isset($_SESSION['answers'][$questionIdForButton]) && !empty($_SESSION['answers'][$questionIdForButton]) ? 'answered' : '';

            echo "<button type='submit' name='question_id' value='$questionIdForButton' class='question-button $buttonClass'>Soal $i</button>";
        }
        echo "</div>";

        // Tombol untuk mengirim jawaban
        echo "<button class='submitJawaban' type='submit' name='submit_final'>Submit</button>";
        
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

// Fungsi untuk mendapatkan urutan soal berdasarkan ID pertanyaan
function getQuestionOrderById($conn, $subjectId, $questionId) {
    $sql_question_order = "SELECT COUNT(*) AS question_order FROM questions WHERE subject_id = $subjectId AND id <= $questionId";
    $result_question_order = $conn->query($sql_question_order);

    if ($result_question_order && $result_question_order->num_rows > 0) {
        $row_question_order = $result_question_order->fetch_assoc();
        return $row_question_order['question_order'];
    } else {
        return 1; // Jika tidak ada pertanyaan, kembalikan nilai default 1
    }
}

// Fungsi untuk mendapatkan ID pertanyaan sebelumnya
function getPreviousQuestionId($conn, $subjectId, $currentQuestionId) {
    $sql_prev_question = "SELECT id FROM questions WHERE subject_id = $subjectId AND id < $currentQuestionId ORDER BY id DESC LIMIT 1";
    $result_prev_question = $conn->query($sql_prev_question);

    if ($result_prev_question && $result_prev_question->num_rows > 0) {
        $row_prev_question = $result_prev_question->fetch_assoc();
        return $row_prev_question['id'];
    } else {
        return null;
    }
}

// Fungsi untuk mendapatkan ID pertanyaan berikutnya
function getNextQuestionId($conn, $subjectId, $currentQuestionId) {
    $sql_next_question = "SELECT id FROM questions WHERE subject_id = $subjectId AND id > $currentQuestionId ORDER BY id ASC LIMIT 1";
    $result_next_question = $conn->query($sql_next_question);

    if ($result_next_question && $result_next_question->num_rows > 0) {
        $row_next_question = $result_next_question->fetch_assoc();
        return $row_next_question['id'];
    } else {
        return null;
    }
}
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Menangkap semua tombol soal
    var buttons = document.querySelectorAll('.question-button');

    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Menghapus kelas 'active-button' dari semua tombol
            buttons.forEach(function(btn) {
                btn.classList.remove('active-button');
            });

            // Menambahkan kelas 'active-button' ke tombol yang ditekan
            this.classList.add('active-button');
        });
    });
});
</script>

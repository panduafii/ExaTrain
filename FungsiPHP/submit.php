<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username Anda
$password = "root"; // Ganti dengan password Anda
$dbname = "ExaTrain";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Memeriksa apakah data jawaban diterima dari formulir
if (isset($_POST['essay_answer'])) {
    $essay_answers = $_POST['essay_answer'];

    // Loop melalui setiap jawaban dan menyimpannya ke database
    foreach ($essay_answers as $key => $answer) {
        // Melakukan sanitasi data untuk menghindari serangan SQL Injection
        $sanitized_answer = $conn->real_escape_string($answer);

        // Menyusun query untuk menyimpan jawaban ke database
        $question_id = $key + 1; // Menyesuaikan dengan indeks pertanyaan
        $sql = "INSERT INTO essay_answers (user_id, question_id, answer) VALUES (1, $question_id, '$sanitized_answer')"; // Sesuaikan dengan ID pengguna dan ID pertanyaan yang sesuai
        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error; // Menampilkan pesan kesalahan jika query gagal dieksekusi
        }
    }
} else {
    echo "Data jawaban tidak diterima.";
}

// Menutup koneksi
$conn->close();
?>

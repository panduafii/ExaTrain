<?php
// Memulai sesi
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika tidak ada sesi username, arahkan pengguna kembali ke halaman login
    header("Location: loginRegist.php");
    exit; // Pastikan tidak ada kode ekstra yang dijalankan setelah pengalihan header
}

// Pastikan mata kuliah yang dipilih sudah disimpan di session
if (isset($_SESSION['selected_course'])) {
    $selectedCourse = $_SESSION['selected_course'];

    // Koneksi ke database (sesuaikan dengan konfigurasi Anda)
    $servername = "localhost";
    $username = "root"; // Ganti dengan username Anda
    $password = ""; // Ganti dengan password Anda
    $dbname = "ExaTrain";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi ke database gagal: " . $conn->connect_error);
    }

    // Query untuk mengambil soal berdasarkan mata kuliah yang dipilih
    $sql = "SELECT * FROM questions WHERE subject_id = (SELECT id FROM subject WHERE subject_name = '$selectedCourse')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Menampilkan soal-soal
        while ($row = $result->fetch_assoc()) {
            echo "<h2>" . $row['question_text'] . "</h2>";
            // Tambahkan logika untuk menampilkan form soal di sini
            echo "<textarea name='essay_answer'></textarea>"; // Contoh textarea untuk jawaban essay
        }
    } else {
        echo "Belum ada soal yang tersedia untuk mata kuliah ini.";
    }

    $conn->close();
} else {
    echo "Mata kuliah belum dipilih.";
}
?>
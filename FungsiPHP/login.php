<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username Anda
$password = ""; // Ganti dengan password Anda
$dbname = "ExaTrain";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Variabel untuk menyimpan pesan error
$error = "";

// Memulai sesi
session_start();

// Memeriksa apakah data login diterima dari formulir
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menyusun query untuk mengambil data pengguna berdasarkan username
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Mengambil data pengguna
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Memverifikasi password
        if (password_verify($password, $hashed_password)) {
            // Login berhasil, mengatur sesi
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user_id;

            // Mengarahkan pengguna ke halaman dashboard.php
            header("Location: ../dashboard.php");
            exit; // Memastikan tidak ada kode ekstra yang dijalankan setelah pengalihan header
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }

    $stmt->close();
}

// Menutup koneksi
$conn->close();

// Menampilkan pesan error jika ada
if (!empty($error)) {
    echo $error;
}
?>

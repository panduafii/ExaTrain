<?php
// Koneksi ke database
include 'connection.php';

// Memulai sesi
session_start();

// Memeriksa apakah data login diterima dari form submission
if (isset($_POST['username']) && isset($_POST['password'])) {
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

            // Redirect ke halaman dashboard
            header("Location: ../dashboard.php");
            exit;
        } else {
            // Password salah
            $_SESSION['error_message'] = 'Password salah.';
            header("Location: ../loginRegist.php");
            exit;
        }
    } else {
        // Username tidak ditemukan
        $_SESSION['error_message'] = 'Username tidak ditemukan.';
        header("Location: ../loginRegist.php");
        exit;
    }

    $stmt->close();
}

// Menutup koneksi
$conn->close();

// Jika tidak ada permintaan POST, kembalikan ke halaman login
header("Location: ../login.php");
exit;
?>

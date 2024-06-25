<?php
// Memulai sesi
session_start();

// Koneksi ke database
$servername = "localhost";
$username = ""; // Ganti dengan username Anda
$password = "root"; // Ganti dengan password Anda
$dbname = "ExaTrain";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Memeriksa apakah data pengguna diterima dari formulir
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $angkatan = $_POST['angkatan'];
    $payment_method = $_POST['payment-method']; // Menambahkan metode pembayaran

    // Hash password sebelum disimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Memulai transaksi
    $conn->begin_transaction();

    try {
        // Menyusun query untuk menambahkan pengguna baru ke database termasuk kolom angkatan
        $stmt = $conn->prepare("INSERT INTO users (username, password, angkatan) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $username, $hashed_password, $angkatan);
        $stmt->execute();
        $user_id = $stmt->insert_id; // Mendapatkan ID pengguna baru
        $stmt->close();

        // Menyusun query untuk menambahkan pembayaran dengan status "paid" ke database
        $stmt = $conn->prepare("INSERT INTO payments (user_id, payment_status) VALUES (?, 'paid')");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();

        // Menyimpan perubahan
        $conn->commit();

        // Mengarahkan pengguna ke halaman loginRegist.php setelah menambahkan pengguna baru
        header("Location: ../loginRegist.php");
        exit;
    } catch (Exception $e) {
        // Melakukan rollback jika terjadi kesalahan
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}

// Menutup koneksi
$conn->close();
?>

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

// Memeriksa apakah data pengguna diterima dari formulir
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash password sebelum disimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Menyusun query untuk menambahkan pengguna baru ke database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
    if ($conn->query($sql) === TRUE) {
        // Mengarahkan pengguna kembali ke halaman index.php setelah menambahkan pengguna baru
        header("Location: ../dashboard.php");
        exit; // Memastikan tidak ada kode ekstra yang dijalankan setelah pengalihan header
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; // Menampilkan pesan kesalahan jika query gagal dieksekusi
    }
}

// Menutup koneksi
$conn->close();
?>

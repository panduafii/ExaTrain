<?php
session_start();

// Cek apakah session subject_id ada
if (!isset($_SESSION['subject_id'])) {
    header('Location: adminSoal.php');
    exit;
}

$subject_id = $_SESSION['subject_id'];

// Koneksi ke database dan query untuk mendapatkan data terkait berdasarkan $subject_id
// Misalnya, menghubungkan ke database untuk mendapatkan statistik atau informasi lain yang diperlukan


// Koneksi ke database
include '../fungsiPHP/connection.php';

// Mengambil nama subject berdasarkan subject_id
$subjectQuery = "SELECT subject_name FROM subject WHERE id = " . $subject_id;
$subjectResult = $conn->query($subjectQuery);
if ($subjectResult->num_rows > 0) {
    $subjectRow = $subjectResult->fetch_assoc();
    $subject_name = $subjectRow['subject_name'];
} else {
    $subject_name = "Nama Mata Kuliah Tidak Ditemukan";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart Soal</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="../CSS/adminsoalchart.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="logo">
                <img src="../img/logo1.png" alt="EXATrain Logo">
                <div class="logo-line"></div> <!-- Div untuk garis putih -->
            </div>
            <ul class="sidebar-menu">
                <a href="adminPengguna.php">
                    <li class="sidebar-item">
                        <img src="../img/penggunaicon.png" alt="Icon">
                        <span>Edit Pengguna</span>
                    </li>
                </a>
                <a href="adminSoal.php">
                    <li class="sidebar-item">
                        <img src="../img/manajemenicon.png" alt="Icon">
                        <span>Manajemen Soal</span>
                    </li>
                </a>
                <a href="adminStatistik.php">
                    <li class="sidebar-item">
                        <img src="../img/statistikicon.png" alt="Icon">
                        <span>Data & Statistik</span>
                    </li>
                </a>
                <a href="adminPembayaran.php">
                    <li class="sidebar-item">
                        <img src="../img/wallet-2.png" alt="Icon">
                        <span>Pembayaran</span>
                    </li>
                </a>
            </ul>
            <ul class="logout">
                <a href="../loginRegist.php">
                    <li class="sidebar-item">
                        <img src="../img/logouticon.png" alt="Icon">
                        <span>Logout</span>
                    </li>
                </a>
            </ul>
        </nav>
        <div class="main-content">
            <header class="header">
                <ul class="header-menu">
                    <li class="header-right">
                        <div class="user-icon">
                            <img src="../img/adminicon.png" alt="User">
                        </div>
                        <span>Admin</span>
                    </li>
                </ul>
            </header>
            <div class="sub-header">
                <span>Chart Soal</span>
            </div>
            <div class="title">
                <h3><?php echo $subject_name; ?></h3>
            </div>
            <div class="content">
                <div class="charts">
                    <div class="chart" id="average-grades-chart">
                        <h4></h4> <!-- Moved text to the top -->
                    </div>

                    <div class="chart" id="user-activity-chart">
                        <h4></h4> <!-- Moved text to the top -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

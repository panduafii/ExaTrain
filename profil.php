<?php
 session_start();

 // Menampilkan nama pengguna jika ada yang masuk
 if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    
} else {
    echo "Hi!";
}

// Menghubungkan ke database
include 'fungsiPHP/connection.php';

// Mengambil data pengguna dari database
$user_id = $_SESSION['user_id'];
$sql = "SELECT id, username, angkatan FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    $user_id = $user['id'];
    $username = $user['username'];
    $angkatan = $user['angkatan'] ?: '-'; // Jika angkatan null, tampilkan '-'
} else {
    echo "Pengguna tidak ditemukan";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data dan Statistik</title>
    <link rel="stylesheet" href="CSS/profil.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
</head>
<body>
    <!-- Navbar -->
    <header>
    <nav class="navbar">
            <div class="logo">
                <img src="img/logo.png" alt="Logo" />
            </div>
            <ul class="menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="pilihanMatkul.php">Mata Kuliah</a></li>
                <li><a href="paring.php">Papan Peringkat</a></li>
                <li><a href="aboutUs.php">Tentang Kami</a></li>
                <li>
                    <?php
                        echo "Hi! $username";
                    ?>
                </li>
                <li><a href="profil.php"><img src="img/avatar.png" alt="User" class="user-icon"></a></li>
                <!-- <li></li> -->
            </ul>
            <div class="menu-toggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </nav>
    </header>

    <div class="back-button" onclick="goBack()">
    &larr; 
    </div>

    <!-- End -->
    <div class="container">
            <div class="profile">
                <div class="profile-header">
                    <img src="img/profile-picture.png" alt="User">
                    <span class="user-name"><?php echo "$username";?></span>
                </div>
                <table>
                    <tr>
                        <td>ID :</td>
                        <td><?php echo $user_id; ?></td>
                    </tr>
                    <tr>
                        <td>Username :</td>
                        <td><?php echo "$username";?></td>
                    </tr>
                    <tr>
                        <td>Angkatan :</td>
                        <td><?php echo $angkatan; ?></td>
                    </tr>
                </table>
                <a href="loginRegist.php">
                <div class="logout-wrapper">
                     <button class="logout-button">
                        <img src="img/logout-hitam.png" alt="Edit Icon" class="button-icon-logout">
                        <span>Logout</span>
                    </button>
                </a>
            </div>
            </div>
        <div class="main-content">
            <h1>Data dan Statistik</h1>
            <div class="chart-container">
                <div class="chart" id="pie-chart">
                    <!-- Pie chart will be inserted here -->
                </div>
            </div>
            <div class="chart-container">
                <div class="chart" id="bar-chart">
                    <!-- Bar chart will be inserted here -->
                </div>
            </div>
            <div class="chart-container">
                <div class="chart" id="bar-chart">
                    <!-- Bar chart will be inserted here -->
                </div>
            </div>
            <div class="chart-container">
                <div class="chart" id="bar-chart">
                    <!-- Bar chart will be inserted here -->
                </div>
            </div>
        </div>
    </div>
    <script>
function goBack() {
    history.back();
}
</script>

</body>
</html>

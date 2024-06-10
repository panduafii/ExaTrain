<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data & Statistik</title>
    <link rel="stylesheet" href="CSS/adminstatistik.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
</head>

<body>
    <div class="container">
        <nav class="sidebar">
            <div class="logo">
                <img src="img/logo1.png" alt="EXATrain Logo">
                <div class="logo-line"></div> <!-- Div untuk garis putih -->
            </div>
            <ul class="sidebar-menu">
                <li class="sidebar-item">
                    <img src="img/penggunaicon.png" alt="Icon">
                    <span>Edit Pengguna</span>
                </li>
                <li class="sidebar-item">
                    <img src="img/manajemenicon.png" alt="Icon">
                    <span>Manajemen Soal</span>
                </li>
                <li class="sidebar-item">
                    <img src="img/statistikicon.png" alt="Icon">
                    <span>Data & Statistik</span>
                </li>
                <li class="sidebar-item">
                    <img src="img/wallet-2.png" alt="Icon">
                    <span>Pembayaran</span>
                </li>
            </ul>
            <ul class="logout">
                <li class="sidebar-item">
                    <img src="img/logouticon.png" alt="Icon">
                    <span>Logout</span>
                </li>
            </ul>
        </nav>
        <div class="main-content">
            <header class="header">
                <ul class="header-menu">
                    <li class="menu-icon">
                        <img src="img/garistiga.png" alt="Menu">
                    </li>
                    <li class="header-right">
                        <div class="notification-icon">
                            <img src="img/Notifikasi.png" alt="Notification">
                        </div>
                        <div class="user-icon">
                            <img src="img/adminicon.png" alt="User">
                        </div>
                        <span>Admin</span>
                    </li>
                </ul>
            </header>
            <div class="sub-header">
                <span>Data & Statistik</span>
            </div>
            <div class="title">
                <h3>Data & Statistik</h3>
            </div>
            <div class="content">
                <div class="charts">
                    <div class="chart" id="user-count-chart">
                        <h4>Jumlah Pengguna</h4> <!-- Moved text to the top -->
                    </div>
                    <div class="chart" id="course-distribution-chart">
                        <h4>Pengerjaan Mata Kuliah Total</h4> <!-- Moved text to the top -->
                    </div>
                    <div class="chart" id="average-grades-chart">
                        <h4>Rata-Rata Nilai Tiap Angkatan / Periode</h4> <!-- Moved text to the top -->
                    </div>
                    <div class="chart" id="user-activity-chart">
                        <h4>Keaktifan Pengguna / Periode</h4> <!-- Moved text to the top -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
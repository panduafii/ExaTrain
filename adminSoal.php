<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Soal</title>
    <link rel="stylesheet" href="CSS/adminsoal.css">
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
                <span>Manajemen Soal</span>
            </div>
            <div class="title">
                <h3>Manajemen Soal</h3>
            </div>
            <div class="content">
                <div class="filter">
                    <label for="filter-by">Filter By:</label>
                    <select id="filter-by">
                        <option value="">Select...</option>
                    </select>
                    <div class="year-buttons">
                        <button class="year-button">2023</button>
                        <button class="year-button">2022</button>
                        <button class="year-button">2021</button>
                    </div>
                    <div class="line-atas"></div> <!-- Div untuk garis putih -->
                </div>
                <div class="questions">
                    <div class="question-card">
                        <img src="img/iconpsi.png" alt="Icon">
                        <span>Pengembangan Sistem Informasi</span>
                    </div>
                    <div class="question-card">
                        <img src="img/icongmm.png" alt="Icon">
                        <span>Grafika dan Multimedia</span>
                    </div>
                    <div class="question-card">
                        <img src="img/iconscpk.png" alt="Icon">
                        <span>Sistem Cerdas dan Pendukung Keputusan</span>
                    </div>
                    <div class="question-card">
                        <img src="img/iconbiki.png" alt="Icon">
                        <span>Bahasa Indonesia Komunikasi Ilmiah</span>
                    </div>
                    <div class="question-card">
                        <img src="img/iconbiti.png" alt="Icon">
                        <span>Bahasa Inggris Teknologi Informasi</span>
                    </div>
                    <div class="question-card">
                        <img src="img/iconulil.png" alt="Icon">
                        <span>Islam Ulil Albab</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
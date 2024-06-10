<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data & Statistik</title>
    <link rel="stylesheet" href="CSS/adminstatistik.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <h1>EX<span>TRAIN</span></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="#"><i class="fas fa-user"></i> Edit Pengguna</a></li>
                    <li><a href="#"><i class="fas fa-tasks"></i> Manajemen Soal</a></li>
                    <li><a href="#" class="active"><i class="fas fa-chart-bar"></i> Data & Statistik</a></li>
                    <li><a href="#"><i class="fas fa-credit-card"></i> Pembayaran</a></li>
                </ul>
            </nav>
            <div class="logout">
                <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </aside>
        <main class="content">
            <header>
                <div class="header-left">
                    <h2>Data & Statistik</h2>
                </div>
                <div class="header-right">
                    <a href="#" class="notification"><i class="fas fa-bell"></i></a>
                    <a href="#" class="profile"><i class="fas fa-user"></i> Admin</a>
                </div>
            </header>
            <section class="statistics">
                <div class="stat-card">
                    <h3>Jumlah Pengguna</h3>
                    <div id="userChart" class="chart-placeholder"></div>
                </div>
                <div class="stat-card">
                    <h3>Pengerjaan Mata Kuliah</h3>
                    <div id="courseChart" class="chart-placeholder"></div>
                </div>
                <div class="stat-card">
                    <h3>Rata-Rata Nilai</h3>
                    <div id="scoreChart" class="chart-placeholder"></div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>

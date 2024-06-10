<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Soal</title>
    <link rel="stylesheet" href="CSS/adminsoal.css">
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
                    <li><a href="#" class="active"><i class="fas fa-tasks"></i> Manajemen Soal</a></li>
                    <li><a href="#"><i class="fas fa-chart-bar"></i> Data & Statistik</a></li>
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
                    <h2>Manajemen Soal</h2>
                </div>
                <div class="header-right">
                    <a href="#" class="notification"><i class="fas fa-bell"></i></a>
                    <a href="#" class="profile"><i class="fas fa-user"></i> Admin</a>
                </div>
            </header>
            <section class="manage-questions">
                <div class="filter-bar">
                    <label for="filter">Filter By:</label>
                    <select id="filter">
                        <option value="all">All</option>
                    </select>
                    <div class="year-buttons">
                        <button>2023</button>
                        <button class="active">2022</button>
                        <button>2021</button>
                    </div>
                </div>
                <div class="subject-cards">
                    <div class="card">
                        <div class="icon">Icon1</div>
                        <div class="info">
                            <p>Pengenbangan Sistem Informasi</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="icon">Icon2</div>
                        <div class="info">
                            <p>Grafika dan Mutimedia</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="icon">Icon3</div>
                        <div class="info">
                            <p>Sistem Cerdas dan Pendukung Keputusan</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="icon">Icon4</div>
                        <div class="info">
                            <p>Bahasa Indonesia Komunikasi Ilmiah</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="icon">Icon5</div>
                        <div class="info">
                            <p>Bahasa Inggris Teknologi Informasi</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="icon">Icon6</div>
                        <div class="info">
                            <p>Islam Ulil Albab</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <!-- JavaScript for dynamic content will be added here later -->
</body>
</html>

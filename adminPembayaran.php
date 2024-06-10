<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="CSS/adminpembayaran.css">
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
                    <li><a href="#"><i class="fas fa-chart-bar"></i> Data & Statistik</a></li>
                    <li><a href="#" class="active"><i class="fas fa-credit-card"></i> Pembayaran</a></li>
                </ul>
            </nav>
            <div class="logout">
                <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </aside>
        <main class="content">
            <header>
                <div class="header-left">
                    <h2>Pembayaran</h2>
                </div>
                <div class="header-right">
                    <a href="#" class="notification"><i class="fas fa-bell"></i></a>
                    <a href="#" class="profile"><i class="fas fa-user"></i> Admin</a>
                </div>
            </header>
            <section class="payment">
                <div class="payment-card">
                    <input type="text" class="search-bar" placeholder="Cari Pengguna">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Nominal</th>
                                <th>Waktu Pembayaran</th>
                                <th>Masa Pakai</th>
                                <th>Akses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Xavier</td>
                                <td>Rp20.000</td>
                                <td>12-05-2024</td>
                                <td>08:10 WIB</td>
                                <td>6 Bulan</td>
                                <td><span class="status aktif">Aktif</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="transaction-history">
                    <h3>Riwayat Transaksi</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Waktu</th>
                                <th>Nominal</th>
                                <th>Metode Pembayaran</th>
                                <th>Masa Pakai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be filled dynamically from the database -->
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
    <!-- JavaScript for dynamic content will be added here later -->
</body>
</html>

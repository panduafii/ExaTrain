<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="CSS/adminpembayaran.css">
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
                <li class="sidebar-item active">
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
                <span>Pembayaran</span>
            </div>
            <div class="content">
                <div class="payment-table">
                    <div class="search-payment">
                        <input type="text" class="search-bar" placeholder="Cari Pengguna">
                    </div>
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
                                <td></td>
                                <td>Xavier</td>
                                <td>Rp 20.000</td>
                                <td>12-05-2024  08.10 WIB</td>
                                <td>6 Bulan</td>
                                <td class="table-icons">
                                    <span class="status-text active">Aktif</span>
                                    <span class="icon-container">
                                        <img src="img/editicon.png" alt="Edit Icon">
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="transaction-history">
                    <h4>Riwayat Transaksi</h4>
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
                            <tr>
                                <td>1189356</td>
                                <td>
                                    <div class="table-icons">
                                        <img src="img/iconriwayat.png" alt="User Icon" class="icon-container">
                                        <span>Dubi1</span>
                                    </div>
                                </td>
                                <td>11-05-2024</td>
                                <td>Rp30.000</td>
                                <td>Transfer Bank</td>
                                <td>3 Bulan</td>
                                <td><span class="status approved">Disetujui</span></td>
                            </tr>
                            <tr>
                                <td>1189356</td>
                                <td>
                                    <div class="table-icons">
                                        <img src="img/iconriwayat.png" alt="User Icon" class="icon-container">
                                        <span>RyaBlessing</span>
                                    </div>
                                </td>
                                <td>01-05-2024</td>
                                <td>Rp30.000</td>
                                <td>Transfer Bank</td>
                                <td>3 Bulan</td>
                                <td><span class="status pending">Tertunda</span></td>
                            </tr>
                            <!-- Tambahkan baris data lain sesuai kebutuhan -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

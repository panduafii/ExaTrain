<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="CSS/adminpengguna.css">
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
                <span>Edit Pengguna</span>
            </div>
            <div class="content">
                <div class="database-table">
                    <div class="search-container">
                        <input type="text" class="search-bar" placeholder="Cari Pengguna">
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Password</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Xavier</td>
                                <td>xavierpradana33@gmail.com</td>
                                <td>087855551234</td>
                                <td>**********</td>
                                <td class="table-icons">
                                    <img src="img/editicon.png" alt="Edit">
                                    <img src="img/deleteicon.png" alt="Delete">
                                    <img src="img/addicon.png" alt="Add">
                                    <img src="img/saveicon.png" alt="Save">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <span>Tampilkan</span>
                        <select>
                            <option value="1">1</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                        <span>Dari 1 Total Data</span>
                    </div>
                </div>
                <div class="user-review">
                    <div class="review-header">
                        <img src="img/teropong.png" alt="Search">
                        <span>Tinjau Jawaban Pengguna</span>
                        <img src="img/polygon.png" alt="Polygon" class="polygon-icon">
                    </div>
                </div>
                <div class="charts">
                    <div class="chart" id="user-profile"></div>
                    <div class="chart" id="course-distribution"></div>
                    <div class="chart" id="correct-incorrect"></div>
                    <div class="chart" id="average-grades"></div>
                    <div class="chart" id="average-scores"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="../CSS/adminpengguna.css">
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['user_id'])): ?>
        <div class="notification">
            <!-- Session User ID: <?php echo $_SESSION['user_id']; ?> -->
        </div>
        <?php endif; ?>
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
                <span>Edit Pengguna</span>
            </div>
            <div class="content">
                <div class="database-table">
                    <div class="search-container">
                        <input type="text" id="search-bar" class="search-bar" placeholder="Cari Pengguna" onkeyup="searchUser()">
                    </div>
                    <table id="user-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../fungsiPHP/connection.php';

                            $sql = "SELECT id, username, password FROM users";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $index = 1;
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr onclick='setUserSession(" . $row['id'] . ")'>";
                                    echo "<td>" . $index++ . "</td>";
                                    echo "<td>" . $row['username'] . "</td>";
                                    echo "<td class='table-icons'>
                                            <img src='../img/editicon.png' alt='Edit'>
                                            <img src='../img/deleteicon.png' alt='Delete'>
                                            <img src='../img/addicon.png' alt='Add'>
                                            <img src='../img/saveicon.png' alt='Save'>
                                        </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>Tidak ada data yang ditemukan.</td></tr>";
                            }

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <span>Tampilkan</span>
                        <select id="rowsPerPage" onchange="changeRowsPerPage()">
                            <option value="1">1</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                        <span id="totalRows"></span>
                    </div>
                </div>
                <a href="adminPenggunadetailjawaban.php" class="user-review">
                    <div class="review-header">
                        <img src="../img/teropong.png" alt="Search">
                        <span>Tinjau Jawaban Pengguna</span>
                        <img src="../img/polygon.png" alt="Polygon" class="polygon-icon">
                    </div>
                </a>
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

    <script>
        function searchUser() {
            const input = document.getElementById('search-bar').value.toUpperCase();
            const table = document.getElementById('user-table');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName('td')[1];
                if (td) {
                    const txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(input) > -1) {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        }

        function setUserSession(userId) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "set_user_session.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log("Session user ID set to: " + userId);
                    // Redirect to another page or refresh the current page
                    window.location.reload();
                }
            };
            xhr.send("user_id=" + userId);
        }

        function changeRowsPerPage() {
            const select = document.getElementById('rowsPerPage');
            const rowsPerPage = parseInt(select.value);
            const table = document.getElementById('user-table').getElementsByTagName('tbody')[0];
            const rows = table.getElementsByTagName('tr');
            const totalRows = rows.length;

            // Tampilkan baris sesuai dengan jumlah yang dipilih
            for (let i = 0; i < totalRows; i++) {
                if (i < rowsPerPage) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }

            // Perbarui teks total data
            const totalRowsText = document.getElementById('totalRows');
            totalRowsText.textContent = `Dari ${totalRows} Total Data`;
        }

        // Inisialisasi jumlah baris yang ditampilkan
        document.addEventListener('DOMContentLoaded', () => {
            changeRowsPerPage();
        });
    </script>
</body>
</html>

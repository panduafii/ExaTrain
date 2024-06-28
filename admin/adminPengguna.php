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
                            // Koneksi ke database
                            $servername = "localhost";
                            $username = "root";
                            $password = "root";
                            $dbname = "ExaTrain";

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Koneksi ke database gagal: " . $conn->connect_error);
                            }

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
                        <select>
                            <option value="1">1</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                        <span>Dari 1 Total Data</span>
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
                    <div class="chart" id="user-profile">
                        <h4>Profil Pengguna</h4>
                    </div>

                    <div class="chart" id="course-distribution">
                        <h4>Pengerjaan Mata Kuliah</h4>
                        <canvas id="courseDistributionChart"></canvas>
                    </div>

                    <div class="chart" id="correct-incorrect">
                        <h4>Salah dan Benar</h4>
                        <canvas id="CRC"></canvas>
                    </div>

                    <div class="chart" id="average-grades">
                        <h4>Rata-Rata Nilai Tiap Mata Kuliah</h4>
                        <canvas id="averageGrades"></canvas>
                    </div>

                    <div class="chart" id="average-scores">
                        <h4>Rata-Rata Nilai Seluruh Mata Kuliah Tiap Periode</h4>
                        <canvas id="averageScores"></canvas>
                    </div>
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
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        // Generate random positive data without a max value constraint
        function generateRandomData(count) {
            let data = [];
            for (let i = 0; i < count; i++) {
                data.push(Math.floor(Math.random() * 100)); // Generate random numbers between 0 and 99
            }
            return data;
        }

    window.onload = function(){
        // Bar Chart for Correct Incorrect
        const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
        const DATA_COUNT = 7;

        

        const CRCData = {
            labels: labels,
            datasets: [{
                label: 'Dataset 1',
                data: generateRandomData(DATA_COUNT),
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1
            },
            {
                label: 'Dataset 2',
                data: generateRandomData(DATA_COUNT),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1
            }]
        };

        const CRCConfig = {
            type: 'bar',
            data: CRCData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const CRCCtx = document.getElementById('CRC').getContext('2d');
        new Chart(CRCCtx, CRCConfig);

        // Bar Chart for Average Grades
        const averageGradesData = {
            labels: labels,
            datasets: [{
                label: 'Dataset 1',
                data: generateRandomData(DATA_COUNT),
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1
            }]
        };

        const averageGradesConfig = {
            type: 'bar',
            data: averageGradesData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const averageGradesCtx = document.getElementById('averageGrades').getContext('2d');
        new Chart(averageGradesCtx, averageGradesConfig);


        // Doughnut Chart for Course Distribution
        const doughnutData = {
                labels: ['Red', 'Blue', 'Yellow'],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            };

            const doughnutConfig = {
                type: 'doughnut',
                data: doughnutData,
            };

            const doughnutCtx = document.getElementById('courseDistributionChart').getContext('2d');
            new Chart(doughnutCtx, doughnutConfig); 
        
        // Line Chart
        const averageScoresData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
        label: 'My First Dataset',
        data: [65, 59, 80, 81, 56, 55, 40],
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
            }]
        };

        const averageScoresConfig = {
        type: 'line',
        data: averageScoresData,
        };

        const lineCtx = document.getElementById('averageScores').getContext('2d');
        new Chart(lineCtx, averageScoresConfig); 
    };

    </script>

</body>
</html>

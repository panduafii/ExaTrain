<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../fungsiPHP/connection.php';

// Fungsi untuk mendapatkan data profil pengguna
function getUserProfileData($userId, $conn) {
    // Mendapatkan data pengguna
    $sql = "SELECT username FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement (users): " . $conn->error);
    }
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $userResult = $stmt->get_result();
    if (!$userResult) {
        die("Error executing query (users): " . $stmt->error);
    }
    $userData = $userResult->fetch_assoc();

    // Mendapatkan status pembayaran
    $sql = "SELECT payment_status FROM payments WHERE user_id = ? ORDER BY id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement (payments): " . $conn->error);
    }
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $paymentResult = $stmt->get_result();
    if (!$paymentResult) {
        die("Error executing query (payments): " . $stmt->error);
    }
    $paymentData = $paymentResult->fetch_assoc();

    // Mendapatkan total pengerjaan
    $sql = "SELECT COUNT(DISTINCT subject_id) AS total_subjects, COUNT(*) AS total_answers FROM answers WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement (answers): " . $conn->error);
    }
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $totalResult = $stmt->get_result();
    if (!$totalResult) {
        die("Error executing query (answers): " . $stmt->error);
    }
    $totalData = $totalResult->fetch_assoc();

    // Mendapatkan ranking
    $sql = "SELECT u.id, u.username, COALESCE(SUM(a.is_correct), 0) AS total_correct
            FROM users u
            LEFT JOIN answers a ON u.id = a.user_id AND a.is_correct = 1
            GROUP BY u.id, u.username
            ORDER BY total_correct DESC, u.username";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement (ranking): " . $conn->error);
    }
    $stmt->execute();
    $rankingResult = $stmt->get_result();
    if (!$rankingResult) {
        die("Error executing query (ranking): " . $stmt->error);
    }

    $ranking = 0;
    $currentRank = 1;
    while ($row = $rankingResult->fetch_assoc()) {
        if ($row['id'] == $userId) {
            $ranking = $currentRank;
            break;
        }
        $currentRank++;
    }

    $stmt->close();

    $profileData = array_merge($userData, $paymentData, $totalData, ['ranking' => $ranking]);

    return json_encode($profileData);
}

// Fungsi untuk mendapatkan data doughnut chart
function getDoughnutChartData($userId) {
    global $conn;

    $sql = "SELECT s.subject_name as subject_name, COUNT(a.subject_id) as count 
            FROM answers a
            JOIN subject s ON a.subject_id = s.id
            WHERE a.user_id = ?
            GROUP BY a.subject_id";
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement (doughnut): " . $conn->error);
    }
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        die("Error executing query (doughnut): " . $stmt->error);
    }

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();
    return json_encode($data);
}

// Fungsi untuk mendapatkan data CRC chart berdasarkan periode 3 bulan
function getCRCChartData($userId) {
    global $conn;

    $sql = "SELECT 
                CONCAT(YEAR(a.created_at), '-', LPAD(CEIL(MONTH(a.created_at) / 3), 2, '0')) as period,
                SUM(CASE WHEN a.is_correct = 1 THEN 1 ELSE 0 END) as correct,
                SUM(CASE WHEN a.is_correct = 0 THEN 1 ELSE 0 END) as incorrect
            FROM answers a
            WHERE a.user_id = ?
            GROUP BY period";
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement (CRC): " . $conn->error);
    }
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        die("Error executing query (CRC): " . $stmt->error);
    }

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();
    return json_encode($data);
}

// Fungsi untuk mendapatkan data average grades chart
function getAverageGradesChartData($userId) {
    global $conn;

    $sql = "SELECT s.subject_name as subject_name, AVG(a.is_correct) as average_grade 
            FROM answers a
            JOIN subject s ON a.subject_id = s.id
            WHERE a.user_id = ?
            GROUP BY a.subject_id";
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement (average grades): " . $conn->error);
    }
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        die("Error executing query (average grades): " . $stmt->error);
    }

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();
    return json_encode($data);
}

// Fungsi untuk mendapatkan data average scores chart
function getAverageScoresChartData($userId) {
    global $conn;

    $sql = "SELECT DATE_FORMAT(a.created_at, '%Y-%m') as period, AVG(a.is_correct) as average_score 
            FROM answers a
            WHERE a.user_id = ?
            GROUP BY period";
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement (average scores): " . $conn->error);
    }
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        die("Error executing query (average scores): " . $stmt->error);
    }

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();
    return json_encode($data);
}

if (isset($_POST['user_id']) && isset($_POST['chart_type'])) {
    $userId = $_POST['user_id'];
    $chartType = $_POST['chart_type'];

    switch ($chartType) {
        case 'profile':
            echo getUserProfileData($userId, $conn);
            break;
        case 'doughnut':
            echo getDoughnutChartData($userId);
            break;
        case 'crc':
            echo getCRCChartData($userId);
            break;
        case 'average_grades':
            echo getAverageGradesChartData($userId);
            break;
        case 'average_scores':
            echo getAverageScoresChartData($userId);
            break;
    }
    exit;
}
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
                <div class="logo-line"></div>
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
                            $sql = "SELECT id, username FROM users";
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
                        <div class="nextB">
                            <button onclick="prevPage()" id="btn-prev">Previous</button>
                            <span id="page-num"></span>
                            <button onclick="nextPage()" id="btn-next">Next</button>
                        </div>
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
                        <ul id="profile-data">
                            <li><strong>Username:</strong> <span id="profile-username"></span></li>
                            <li><strong>User ID:</strong> <span id="profile-userid"></span></li>
                            <li><strong>Ranking:</strong> <span id="profile-ranking"></span></li>
                            <li><strong>Status Pembayaran:</strong> <span id="profile-payment-status"></span></li>
                            <li><strong>Total Pengerjaan:</strong>
                                <ul class="menjorokSedikit">
                                    <li>Mata Kuliah: <span id="profile-total-subjects"></span></li>
                                    <li>Total Soal: <span id="profile-total-answers"></span></li>
                                </ul>
                            </li>
                        </ul>
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
    let doughnutChart = null;
    let crcChart = null;
    let averageGradesChart = null;
    let averageScoresChart = null;

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
                updateUserProfile(userId); // Memperbarui profil pengguna setelah sesi diatur
                updateCharts(userId); // Memperbarui grafik setelah sesi diatur
            }
        };
        xhr.send("user_id=" + userId);
    }

    function updateUserProfile(userId) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "adminPengguna.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                try {
                    const data = JSON.parse(xhr.responseText);
                    document.getElementById('profile-username').innerText = data.username || '';
                    document.getElementById('profile-userid').innerText = userId || '';
                    document.getElementById('profile-ranking').innerText = data.ranking || '';
                    document.getElementById('profile-payment-status').innerText = data.payment_status || '';
                    document.getElementById('profile-total-subjects').innerText = data.total_subjects || '';
                    document.getElementById('profile-total-answers').innerText = data.total_answers || '';
                } catch (error) {
                    console.error("Failed to parse JSON response:", error);
                }
            } else if (xhr.readyState === 4) {
                console.error("Error fetching profile data");
            }
        };
        xhr.onerror = function() {
            console.error("Request error");
        };
        xhr.send("user_id=" + userId + "&chart_type=profile");
    }

    function updateCharts(userId) {
        updateDoughnutChart(userId);
        updateCRCChart(userId);
        updateAverageGradesChart(userId);
        updateAverageScoresChart(userId);
    }

    window.onload = function() {
        const userId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;
        if (userId) {
            updateUserProfile(userId);
            updateCharts(userId);
        }
    };

    function updateDoughnutChart(userId) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "adminPengguna.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                try {
                    const data = JSON.parse(xhr.responseText);

                    const labels = data.map(item => item.subject_name);
                    const counts = data.map(item => item.count);

                    const doughnutData = {
                        labels: labels,
                        datasets: [{
                            label: 'Subject Distribution',
                            data: counts,
                            backgroundColor: [
                                'rgb(255, 99, 132)',
                                'rgb(54, 162, 235)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(153, 102, 255)',
                                'rgb(255, 159, 64)',
                                'rgb(201, 203, 207)'
                            ],
                            hoverOffset: 4
                        }]
                    };

                    if (doughnutChart) {
                        doughnutChart.destroy();
                    }
                    const doughnutCtx = document.getElementById('courseDistributionChart').getContext('2d');
                    doughnutChart = new Chart(doughnutCtx, {
                        type: 'doughnut',
                        data: doughnutData,
                    });
                } catch (error) {
                    console.error("Failed to parse JSON response:", error);
                }
            } else if (xhr.readyState === 4) {
                console.error("Error fetching data for doughnut chart");
            }
        };
        xhr.onerror = function() {
            console.error("Request error");
        };
        xhr.send("user_id=" + userId + "&chart_type=doughnut");
    }

    function updateCRCChart(userId) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "adminPengguna.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                try {
                    const data = JSON.parse(xhr.responseText);

                    const labels = data.map(item => item.period);
                    const correctCounts = data.map(item => item.correct);
                    const incorrectCounts = data.map(item => item.incorrect);

                    const crcData = {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Correct',
                                data: correctCounts,
                                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Incorrect',
                                data: incorrectCounts,
                                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    };

                    if (crcChart) {
                        crcChart.destroy();
                    }
                    const crcCtx = document.getElementById('CRC').getContext('2d');
                    crcChart = new Chart(crcCtx, {
                        type: 'bar',
                        data: crcData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                } catch (error) {
                    console.error("Failed to parse JSON response:", error);
                }
            } else if (xhr.readyState === 4) {
                console.error("Error fetching data for CRC chart");
            }
        };
        xhr.onerror = function() {
            console.error("Request error");
        };
        xhr.send("user_id=" + userId + "&chart_type=crc");
    }

    function updateAverageGradesChart(userId) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "adminPengguna.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                try {
                    const data = JSON.parse(xhr.responseText);

                    const labels = data.map(item => item.subject_name);
                    const averages = data.map(item => item.average_grade);

                    const backgroundColors = labels.map(() => {
                        const r = Math.floor(Math.random() * 255);
                        const g = Math.floor(Math.random() * 255);
                        const b = Math.floor(Math.random() * 255);
                        return `rgba(${r}, ${g}, ${b}, 0.5)`;
                    });

                    const borderColors = labels.map((_, index) => backgroundColors[index].replace('0.5', '1'));

                    const averageGradesData = {
                        labels: labels,
                        datasets: [{
                            label: 'Average Grades',
                            data: averages,
                            backgroundColor: backgroundColors,
                            borderColor: borderColors,
                            borderWidth: 1
                        }]
                    };

                    if (averageGradesChart) {
                        averageGradesChart.destroy();
                    }
                    const averageGradesCtx = document.getElementById('averageGrades').getContext('2d');
                    averageGradesChart = new Chart(averageGradesCtx, {
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
                    });
                } catch (error) {
                    console.error("Failed to parse JSON response:", error);
                }
            } else if (xhr.readyState === 4) {
                console.error("Error fetching data for average grades chart");
            }
        };
        xhr.onerror = function() {
            console.error("Request error");
        };
        xhr.send("user_id=" + userId + "&chart_type=average_grades");
    }

    function updateAverageScoresChart(userId) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "adminPengguna.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                try {
                    const data = JSON.parse(xhr.responseText);

                    const labels = data.map(item => item.period);
                    const averages = data.map(item => item.average_score);

                    const averageScoresData = {
                        labels: labels,
                        datasets: [{
                            label: 'Average Scores per Period',
                            data: averages,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgb(54, 162, 235)',
                            borderWidth: 1
                        }]
                    };

                    if (averageScoresChart) {
                        averageScoresChart.destroy();
                    }
                    const averageScoresCtx = document.getElementById('averageScores').getContext('2d');
                    averageScoresChart = new Chart(averageScoresCtx, {
                        type: 'line',
                        data: averageScoresData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                } catch (error) {
                    console.error("Failed to parse JSON response:", error);
                }
            } else if (xhr.readyState === 4) {
                console.error("Error fetching data for average scores chart");
            }
        };
        xhr.onerror = function() {
            console.error("Request error");
        };
        xhr.send("user_id=" + userId + "&chart_type=average_scores");
    }

    function changeRowsPerPage() {
        const select = document.getElementById('rowsPerPage');
        const rowsPerPage = parseInt(select.value);
        const table = document.getElementById('user-table').getElementsByTagName('tbody')[0];
        const rows = table.getElementsByTagName('tr');
        const totalRows = rows.length;

        for (let i = 0; i < totalRows; i++) {
            if (i < rowsPerPage) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }

        const totalRowsText = document.getElementById('totalRows');
        totalRowsText.textContent = `Dari ${totalRows} Total Data`;
    }

    document.addEventListener('DOMContentLoaded', () => {
        changeRowsPerPage();
    });
</script>


    <script src="../JS/pagination.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>

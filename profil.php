<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginRegist.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fungsi untuk mendapatkan data doughnut chart
function getDoughnutChartData($userId) {
    // Koneksi ke database
    include 'fungsiPHP/connection.php';

    $sql = "SELECT s.subject_name as subject_name, COUNT(a.subject_id) as count 
            FROM answers a
            JOIN subject s ON a.subject_id = s.id
            WHERE a.user_id = ?
            GROUP BY a.subject_id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();
    $conn->close();

    return json_encode($data);
}

// Fungsi untuk mendapatkan data CRC chart berdasarkan periode 3 bulan
function getCRCChartData($userId) {
    // Koneksi ke database
    include 'fungsiPHP/connection.php';

    $sql = "SELECT 
                CONCAT(YEAR(a.created_at), '-', LPAD(CEIL(MONTH(a.created_at) / 3), 2, '0')) as period,
                SUM(CASE WHEN a.is_correct = 1 THEN 1 ELSE 0 END) as correct,
                SUM(CASE WHEN a.is_correct = 0 THEN 1 ELSE 0 END) as incorrect
            FROM answers a
            WHERE a.user_id = ?
            GROUP BY period";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();
    $conn->close();

    return json_encode($data);
}

// Fungsi untuk mendapatkan data average grades chart
function getAverageGradesChartData($userId) {
    // Koneksi ke database
    include 'fungsiPHP/connection.php';

    $sql = "SELECT s.subject_name as subject_name, AVG(a.is_correct) as average_grade 
            FROM answers a
            JOIN subject s ON a.subject_id = s.id
            WHERE a.user_id = ?
            GROUP BY a.subject_id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();
    $conn->close();

    return json_encode($data);
}

// Fungsi untuk mendapatkan data average scores chart
function getAverageScoresChartData($userId) {
    // Koneksi ke database
    include 'fungsiPHP/connection.php';

    // Menggunakan kolom created_at untuk periode waktu
    $sql = "SELECT DATE_FORMAT(a.created_at, '%Y-%m') as period, AVG(a.is_correct) as average_score 
            FROM answers a
            WHERE a.user_id = ?
            GROUP BY period";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();
    $conn->close();

    return json_encode($data);
}

if (isset($_POST['chart_type'])) {
    if ($_POST['chart_type'] == 'crc') {
        echo getCRCChartData($user_id);
    } else if ($_POST['chart_type'] == 'average_grades') {
        echo getAverageGradesChartData($user_id);
    } else if ($_POST['chart_type'] == 'average_scores') {
        echo getAverageScoresChartData($user_id);
    } else {
        echo getDoughnutChartData($user_id);
    }
    exit;
}

// Menghubungkan ke database
include 'fungsiPHP/connection.php';

// Mengambil data pengguna dari database
$user_id = $_SESSION['user_id'];
$sql = "SELECT id, username, angkatan FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    $user_id = $user['id'];
    $username = $user['username'];
    $angkatan = $user['angkatan'] ?: '-'; // Jika angkatan null, tampilkan '-'
} else {
    echo "Pengguna tidak ditemukan";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data dan Statistik</title>
    <link rel="stylesheet" href="CSS/profil.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
</head>
<body>
    <!-- Navbar -->
    <header>
    <nav class="navbar">
            <div class="logo">
                <img src="img/logo.png" alt="Logo" />
            </div>
            <ul class="menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="pilihanMatkul.php">Mata Kuliah</a></li>
                <li><a href="paring.php">Papan Peringkat</a></li>
                <li><a href="aboutUs.php">Tentang Kami</a></li>
                <li>
                    <?php
                        echo "Hi! $username";
                    ?>
                </li>
                <li><a href="profil.php"><img src="img/avatar.png" alt="User" class="user-icon"></a></li>
            </ul>
            <div class="menu-toggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </nav>
    </header>

    <div class="back-button" onclick="goBack()">
    &larr; 
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="profile">
            <div class="profile-header">
                <img src="img/profile-picture.png" alt="User">
                <span class="user-name"><?php echo htmlspecialchars($username); ?></span>
            </div>
            <table>
                <tr>
                    <td>ID :</td>
                    <td><?php echo htmlspecialchars($user_id); ?></td>
                </tr>
                <tr>
                    <td>Username :</td>
                    <td><?php echo htmlspecialchars($username); ?></td>
                </tr>
                <tr>
                    <td>Angkatan :</td>
                    <td><?php echo htmlspecialchars($angkatan); ?></td>
                </tr>
            </table>
            
            <a href="loginRegist.php" class="logout-wrapper">
                <button class="logout-button">
                    <img src="img/logout-hitam.png" alt="Logout Icon" class="button-icon-logout">
                    <span>Logout</span>
                </button>
            </a>
        </div>

        <div class="main-content">
            <h1>Data dan Statistik</h1>
            <div class="chart-container">
                <div class="chart" id="course-distribution">
                    <h4>Pengerjaan Mata Kuliah</h4>
                    <canvas id="courseDistributionChart"></canvas>
                </div>
            </div>
            <div class="chart-container">
                <div class="chart" id="correct-incorrect">
                    <h4>Salah dan Benar</h4>
                    <canvas id="CRC"></canvas>
                </div>
            </div>
            <div class="chart-container">
                <div class="chart" id="average-grades">
                    <h4>Rata-Rata Nilai Tiap Mata Kuliah</h4>
                    <canvas id="averageGrades"></canvas>
                </div>
            </div>
            <div class="chart-container">
                <div class="chart" id="average-scores">
                    <h4>Rata-Rata Nilai Seluruh Mata Kuliah Tiap Periode</h4>
                    <canvas id="averageScores"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            history.back();
        }

        window.onload = function() {
            // Fungsi untuk memperbarui chart doughnut
            function updateDoughnutChart() {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "profil.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log(xhr.responseText);
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

                        const doughnutCtx = document.getElementById('courseDistributionChart').getContext('2d');
                        new Chart(doughnutCtx, {
                            type: 'doughnut',
                            data: doughnutData,
                        });
                    } else if (xhr.readyState === 4) {
                        console.error("Error fetching data for doughnut chart");
                    }
                };
                xhr.onerror = function() {
                    console.error("Request error");
                };
                xhr.send("chart_type=doughnut");
            }

            // Fungsi untuk memperbarui chart CRC berdasarkan periode 3 bulan
            function updateCRCChart() {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "profil.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log(xhr.responseText);
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

                        const crcCtx = document.getElementById('CRC').getContext('2d');
                        new Chart(crcCtx, {
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
                    } else if (xhr.readyState === 4) {
                        console.error("Error fetching data for CRC chart");
                    }
                };
                xhr.onerror = function() {
                    console.error("Request error");
                };
                xhr.send("chart_type=crc");
            }

            // Fungsi untuk memperbarui chart average grades
            function updateAverageGradesChart() {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "profil.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log(xhr.responseText);
                        const data = JSON.parse(xhr.responseText);

                        const labels = data.map(item => item.subject_name);
                        const averages = data.map(item => item.average_grade);

                        // Generate random colors for each subject
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

                        const averageGradesCtx = document.getElementById('averageGrades').getContext('2d');
                        new Chart(averageGradesCtx, {
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
                    } else if (xhr.readyState === 4) {
                        console.error("Error fetching data for average grades chart");
                    }
                };
                xhr.onerror = function() {
                    console.error("Request error");
                };
                xhr.send("chart_type=average_grades");
            }

            // Fungsi untuk memperbarui chart average scores
            function updateAverageScoresChart() {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "profil.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log(xhr.responseText);
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

                        const averageScoresCtx = document.getElementById('averageScores').getContext('2d');
                        new Chart(averageScoresCtx, {
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
                    } else if (xhr.readyState === 4) {
                        console.error("Error fetching data for average scores chart");
                    }
                };
                xhr.onerror = function() {
                    console.error("Request error");
                };
                xhr.send("chart_type=average_scores");
            }

            // Panggil fungsi untuk memperbarui chart
            updateDoughnutChart();
            updateCRCChart();
            updateAverageGradesChart();
            updateAverageScoresChart();
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>

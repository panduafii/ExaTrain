<?php
session_start();

// Cek apakah session subject_id ada
if (!isset($_SESSION['subject_id'])) {
    header('Location: adminSoal.php');
    exit;
}

$subject_id = $_SESSION['subject_id'];

// Koneksi ke database
include '../fungsiPHP/connection.php';

// Mengambil nama subject berdasarkan subject_id
$subjectQuery = "SELECT subject_name FROM subject WHERE id = ?";
$stmt = $conn->prepare($subjectQuery);
$stmt->bind_param("i", $subject_id);
$stmt->execute();
$subjectResult = $stmt->get_result();
if ($subjectResult->num_rows > 0) {
    $subjectRow = $subjectResult->fetch_assoc();
    $subject_name = $subjectRow['subject_name'];
} else {
    $subject_name = "Nama Mata Kuliah Tidak Ditemukan";
}
$stmt->close();

// Fungsi untuk mendapatkan data benar
function getCorrectPercentageData($subjectId, $conn) {
    $sql = "SELECT q.id AS question_id, 
                   q.question_text, 
                   SUM(CASE WHEN a.is_correct = 1 THEN 1 ELSE 0 END) AS correct_count,
                   COUNT(a.is_correct) AS total_count
            FROM questions q
            LEFT JOIN answers a ON q.id = a.question_id
            WHERE q.subject_id = ?
            GROUP BY q.id";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    
    $stmt->bind_param("i", $subjectId);
    if ($stmt->execute() === false) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    $result = $stmt->get_result();
    if ($result === false) {
        die('Get result failed: ' . htmlspecialchars($stmt->error));
    }

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $row['correct_percentage'] = ($row['total_count'] > 0) ? ($row['correct_count'] / $row['total_count'] * 100) : 0;
        $data[] = $row;
    }

    $stmt->close();
    error_log(print_r($data, true)); // Log data yang dihasilkan
    return json_encode($data);
}

if (isset($_GET['subject_id'])) {
    $data = getCorrectPercentageData($_GET['subject_id'], $conn);
    header('Content-Type: application/json');
    echo $data;
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart Soal</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="../CSS/adminsoalchart.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
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
                <span>Chart Soal</span>
            </div>
            <div class="title">
                <h3><?php echo $subject_name; ?></h3>
            </div>
            <div class="content">
                <div class="charts">
                    <div class="chart" id="CRCSubject">
                        <h4>Persentase Jawaban Benar</h4>
                        <canvas id="crcChart"></canvas>
                    </div>
                    <div class="chart" id="user-activity-chart">
                        <h4></h4> <!-- Moved text to the top -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const subjectId = <?php echo $subject_id; ?>;
            fetch(`adminSoalchart.php?subject_id=${subjectId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data received:', data); // Log data yang diterima
                    if (!Array.isArray(data) || data.length === 0) {
                        throw new Error('Invalid data format or no data received');
                    }
                    const labels = data.map((item, index) => `Soal ${index + 1}`);
                    const correctData = data.map(item => item.correct_percentage);
                    console.log('Labels:', labels); // Log labels
                    console.log('Correct Data:', correctData); // Log correct data

                    const ctx = document.getElementById('crcChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Benar (%)',
                                    data: correctData,
                                    backgroundColor: 'rgba(0, 0, 139, 1)',
                                    borderColor: 'rgba(0, 0, 139, 1)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 100,
                                    ticks: {
                                        callback: function(value) {
                                            return value + '%';
                                        }
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching data:', error); // Log error
                    alert('Failed to load chart data. Please try again later.');
                });
        });
    </script>
</body>
</html>

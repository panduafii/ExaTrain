<?php
session_start();

// Cek apakah session subject_id ada
if (!isset($_SESSION['subject_id'])) {
    header('Location: adminSoal.php');
    exit;
}

$subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : $_SESSION['subject_id'];

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

// Endpoint to fetch chart data
if (isset($_GET['fetch_data']) && $_GET['fetch_data'] == 'true') {
    $totalCorrectQuery = "
        SELECT COUNT(DISTINCT user_id) AS total_correct
        FROM answers 
        WHERE subject_id = ? AND is_correct = 1
    ";
    $stmt = $conn->prepare($totalCorrectQuery);
    $stmt->bind_param("i", $subject_id);
    $stmt->execute();
    $totalCorrectResult = $stmt->get_result();
    $totalCorrectRow = $totalCorrectResult->fetch_assoc();
    $total_correct = $totalCorrectRow['total_correct'];

    $dataQuery = "
        SELECT q.id AS question_id, COUNT(DISTINCT a.user_id) AS correct_count 
        FROM questions q 
        LEFT JOIN answers a ON q.id = a.question_id AND a.is_correct = 1
        WHERE q.subject_id = ?
        GROUP BY q.id
    ";
    $stmt = $conn->prepare($dataQuery);
    $stmt->bind_param("i", $subject_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $row['correct_percentage'] = ($total_correct > 0) ? ($row['correct_count'] / $total_correct) * 100 : 0;
        $data[] = $row;
    }

    echo json_encode($data);
    exit;
}
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
                <span>Chart Soal</span>
            </div>
            <div class="title">
                <h3><?php echo $subject_name; ?></h3>
            </div>
            <div class="content">
                <div class="charts">
                    <div class="chart" id="CRCSubject">
                        <h4>Kemungkinan Soal Berhasil Dijawab Benar</h4>
                        <canvas id="crcChart"></canvas>
                    </div>

                    <div class="chart" id="user-activity-chart">
                        <h4></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const subjectId = <?php echo $subject_id; ?>;
        fetch(?fetch_data=true&subject_id=${subjectId})
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    console.log('No data available for subject_id:', subjectId);
                    return;
                }

                const labels = data.map((item, index) => Soal ${index + 1});
                const correctData = data.map(item => item.correct_percentage.toFixed(2));
                console.log('Data received:', data);

                const ctx = document.getElementById('crcChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Persentase Jawaban Benar (%)',
                                data: correctData,
                                backgroundColor: 'rgba(255, 127, 0, 1)',
                                borderColor: 'rgba(255, 127, 0, 1)',
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
                                    callback: function(value) { return value + "%"; },
                                    stepSize: 10
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    });
    </script>
</body>
</html>
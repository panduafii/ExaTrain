<?php
// Koneksi ke database
include '../fungsiPHP/connection.php';

// Query untuk mengambil data pengguna berdasarkan bulan dan angkatan
$sql = "
    SELECT 
        YEAR(created_at) as year, 
        MONTH(created_at) as month, 
        angkatan, 
        COUNT(*) as jumlah 
    FROM users 
    GROUP BY year, month, angkatan
";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $year = $row['year'];
        $month = $row['month'];
        $angkatan = $row['angkatan'];
        $jumlah = $row['jumlah'];

        // Mengelompokkan data berdasarkan tahun dan bulan
        if (!isset($data[$year])) {
            $data[$year] = array_fill(0, 12, []);
        }
        if (!isset($data[$year][$month-1])) {
            $data[$year][$month-1] = [];
        }
        $data[$year][$month-1][$angkatan] = $jumlah;
    }
} else {
    echo "0 results";
}

// Query untuk mengambil jumlah pengguna yang mengerjakan setiap subject
$sql_subject = "
    SELECT 
        subject.subject_name, 
        COUNT(DISTINCT answers.user_id) as jumlah_user 
    FROM answers 
    JOIN subject ON answers.subject_id = subject.id 
    GROUP BY subject.subject_name
";
$result_subject = $conn->query($sql_subject);

$subject_data = [];
if ($result_subject->num_rows > 0) {
    while ($row = $result_subject->fetch_assoc()) {
        $subject_data[] = [
            'subject_name' => $row['subject_name'],
            'jumlah_user' => $row['jumlah_user']
        ];
    }
} else {
    echo "0 results";
}

// Query to check data in the answers table for the current year
$sql_check_answers = "
    SELECT 
        * 
    FROM answers 
    WHERE YEAR(created_at) = YEAR(CURRENT_DATE())
";

$result_check_answers = $conn->query($sql_check_answers);

// Query untuk mengambil keaktifan pengguna berdasarkan kolom created_at
$sql_activity = "
    SELECT 
        MONTH(created_at) as month, 
        COUNT(*) as jumlah 
    FROM answers 
    WHERE YEAR(created_at) = YEAR(CURRENT_DATE()) 
    GROUP BY month
";

$result_activity = $conn->query($sql_activity);

$activity_data = array_fill(0, 12, 0); // Inisialisasi array dengan 12 bulan
if ($result_activity->num_rows > 0) {
    while ($row = $result_activity->fetch_assoc()) {
        $month = $row['month'];
        $jumlah = $row['jumlah'];
        $activity_data[$month-1] = $jumlah; // Menyimpan jumlah berdasarkan bulan
    }
} else {
    echo "0 results for activity<br>";
}

// Query untuk mengambil rata-rata nilai per bulan per angkatan
$sql_grades = "
    SELECT 
        u.angkatan,
        MONTH(a.created_at) as month,
        AVG(a.is_correct) as average_grade
    FROM answers a
    JOIN users u ON a.user_id = u.id
    WHERE YEAR(a.created_at) = YEAR(CURRENT_DATE())
    GROUP BY u.angkatan, MONTH(a.created_at)
    ORDER BY u.angkatan, MONTH(a.created_at)
";

$result_grades = $conn->query($sql_grades);

$grades_data = [];
if ($result_grades->num_rows > 0) {
    while ($row = $result_grades->fetch_assoc()) {
        $angkatan = $row['angkatan'];
        $month = $row['month'];
        $average_grade = $row['average_grade'];

        if (!isset($grades_data[$angkatan])) {
            $grades_data[$angkatan] = array_fill(0, 12, 0);
        }
        $grades_data[$angkatan][$month-1] = $average_grade;
    }
} else {
    echo "0 results for grades<br>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data & Statistik</title>
    <link rel="stylesheet" href="../CSS/adminstatistik.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
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
                <span>Data & Statistik</span>
            </div>
            <div class="title">
                <h3>Data & Statistik</h3>
            </div>
            <div class="content">
                <div class="charts">
                    <div class="chart" id="user-count-chart">
                        <h4>Jumlah Pengguna</h4>
                        <canvas id="userCountChart"></canvas>
                    </div>

                    <div class="chart" id="course-distribution-chart">
                        <h4>Pengerjaan Mata Kuliah Total</h4>
                        <canvas id="courseDistributionChart"></canvas>
                    </div>

                    <div class="chart" id="average-grades-chart">
                        <h4>Rata-Rata Nilai Tiap Angkatan / Periode</h4>
                        <canvas id="averageGradesChart"></canvas>
                    </div>

                    <div class="chart" id="user-activity-chart">
                        <h4>Keaktifan Pengguna / Periode</h4>
                        <canvas id="userActivityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Ambil data dari PHP
        const data = <?php echo json_encode($data); ?>;
        const subjectData = <?php echo json_encode($subject_data); ?>;
        const activityData = <?php echo json_encode($activity_data); ?>;
        const gradesData = <?php echo json_encode($grades_data); ?>;

        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        window.onload = function() {
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni', 'Juli', 'Aug', 'Sept', 'Okt', 'Nov', 'Des'];
            const datasets = [];

            for (const year in data) {
                const angkatanData = data[year];
                for (const monthIndex in angkatanData) {
                    const monthData = angkatanData[monthIndex];
                    for (const angkatan in monthData) {
                        let existingDataset = datasets.find(d => d.label === `${angkatan} (${year})`);
                        if (!existingDataset) {
                            existingDataset = {
                                label: `${angkatan} (${year})`,
                                data: new Array(12).fill(0),
                                backgroundColor: getRandomColor()
                            };
                            datasets.push(existingDataset);
                        }
                        existingDataset.data[monthIndex] = monthData[angkatan];
                    }
                }
            }

            const userCountData = {
                labels: months,
                datasets: datasets
            };

            const userCountConfig = {
                type: 'bar',
                data: userCountData,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Jumlah Users berdasarkan Angkatan dan Bulan'
                        },
                    },
                    responsive: true,
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true
                        }
                    }
                }
            };

            const barCtx = document.getElementById('userCountChart').getContext('2d');
            new Chart(barCtx, userCountConfig);

            // Course Distribution Doughnut Chart
            const subjectLabels = subjectData.map(item => item.subject_name);
            const subjectCounts = subjectData.map(item => item.jumlah_user);

            const doughnutData = {
                labels: subjectLabels,
                datasets: [{
                    label: 'Jumlah Pengguna',
                    data: subjectCounts,
                    backgroundColor: subjectLabels.map(() => getRandomColor()),
                    hoverOffset: 4
                }]
            };

            const doughnutConfig = {
                type: 'doughnut',
                data: doughnutData,
            };

            const doughnutCtx = document.getElementById('courseDistributionChart').getContext('2d');
            new Chart(doughnutCtx, doughnutConfig);

            // Average Grades Bar Chart
            const averageGradesData = {
                labels: months,
                datasets: []
            };

            Object.keys(gradesData).forEach(angkatan => {
                const dataset = {
                    label: `Angkatan ${angkatan}`,
                    data: gradesData[angkatan],
                    backgroundColor: getRandomColor(),
                    borderColor: getRandomColor(),
                    borderWidth: 1
                };
                averageGradesData.datasets.push(dataset);
            });

            const averageGradesConfig = {
                type: 'bar',
                data: averageGradesData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 1
                        }
                    }
                }
            };

            const averageGradesCtx = document.getElementById('averageGradesChart').getContext('2d');
            new Chart(averageGradesCtx, averageGradesConfig);

            // User Activity Line Chart
            const userActivityData = {
                labels: months,
                datasets: [{
                    label: 'Keaktifan Pengguna',
                    data: activityData,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            };

            const userActivityConfig = {
                type: 'line',
                data: userActivityData,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Keaktifan Pengguna per Bulan'
                        },
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            const lineCtx = document.getElementById('userActivityChart').getContext('2d');
            new Chart(lineCtx, userActivityConfig);
        };
    </script>
</body>
</html>

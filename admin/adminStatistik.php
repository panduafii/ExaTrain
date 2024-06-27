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
                        <h4>Pengerjaan Mata Kuliah Total</h4> <!-- Moved text to the top -->
                        <canvas id="courseDistributionChart"></canvas>

                    </div>

                    <div class="chart" id="average-grades-chart">
                        <h4>Rata-Rata Nilai Tiap Angkatan / Periode</h4> <!-- Moved text to the top -->
                    </div>

                    <div class="chart" id="user-activity-chart">
                        <h4>Keaktifan Pengguna / Periode</h4> <!-- Moved text to the top -->
                        <canvas id="userActivityChart"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
    <script>
        
        //Bar Chart
               window.onload = function() {
                const userCountData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [
                    {
                        label: 'Dataset 1',
                        data: [65, 59, 80, 81, 56, 55, 40],
                        backgroundColor: 'rgb(255, 99, 132)',
                    },
                    {
                        label: 'Dataset 2',
                        data: [28, 48, 40, 19, 86, 27, 90],
                        backgroundColor: 'rgb(54, 162, 235)',
                    },
                    {
                        label: 'Dataset 3',
                        data: [38, 58, 30, 39, 96, 37, 100],
                        backgroundColor: 'rgb(75, 192, 192)',
                    },
                ]
            };

                const userCountConfig = {
                type: 'bar',
                data: userCountData,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Chart.js Bar Chart - Stacked'
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
        };

        
        // Line Chart
        const userActivityData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
        label: 'My First Dataset',
        data: [65, 59, 80, 81, 56, 55, 40],
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
            }]
        };

        const userActivityConfig = {
        type: 'line',
        data: userActivityData,
        };

        const lineCtx = document.getElementById('userActivityChart').getContext('2d');
     new Chart(lineCtx, userActivityConfig);


    </script>

</body>

</html>
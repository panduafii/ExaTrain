<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXATrain Dashboard - Manajemen Soal</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="../CSS/adminPenggunadetailjawaban.css">
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
                <span>Manajemen Soal</span>
            </div>
            <div class="content">
                <div class="filter">
                    <label for="filter-by">Filter By:</label>
                    <select id="filter-by">
                        <option value="">Select...</option>
                    </select>
                    <div class="year-buttons">
                        <button class="year-button">2023</button>
                        <button class="year-button">2022</button>
                        <button class="year-button">2021</button>
                    </div>
                    <div class="line-atas"></div> <!-- Div untuk garis putih -->
                </div>
                <div class="questions">
                    <!-- 2023 -->
                    <div class="question-card" data-year="2023" data-subject-id="1">
                        <img src="../img/iconpsi.png" alt="Icon">
                        <span>Pengembangan Sistem Informasi</span>
                    </div>
                    <div class="question-card" data-year="2023" data-subject-id="2">
                        <img src="../img/icongmm.png" alt="Icon">
                        <span>Grafika dan Multimedia</span>
                    </div>
                    <div class="question-card" data-year="2023" data-subject-id="3">
                        <img src="../img/iconscpk.png" alt="Icon">
                        <span>Sistem Cerdas dan Pendukung Keputusan</span>
                    </div>
                    <div class="question-card" data-year="2023" data-subject-id="4">
                        <img src="../img/iconbiki.png" alt="Icon">
                        <span>Bahasa Indonesia Komunikasi Ilmiah</span>
                    </div>
                    <div class="question-card" data-year="2023" data-subject-id="5">
                        <img src="../img/iconbiti.png" alt="Icon">
                        <span>Bahasa Inggris Teknologi Informasi</span>
                    </div>
                    <div class="question-card" data-year="2023" data-subject-id="6">
                        <img src="../img/iconulil.png" alt="Icon">
                        <span>Islam Ulil Albab</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Menangani perubahan tampilan mata kuliah berdasarkan tahun yang dipilih
        const yearButtons = document.querySelectorAll('.year-button');
        const questionCards = document.querySelectorAll('.question-card');

        yearButtons.forEach(button => {
            button.addEventListener('click', () => {
                const selectedYear = button.getAttribute('data-year');

                questionCards.forEach(card => {
                    if (card.getAttribute('data-year') === selectedYear) {
                        card.style.visibility = 'visible';
                    } else {
                        card.style.visibility = 'hidden';
                    }
                });
            });
        });

        // Menangani navigasi saat question card diklik
        questionCards.forEach(card => {
            card.addEventListener('click', () => {
                const subjectId = card.getAttribute('data-subject-id');
                setSubjectSession(subjectId);
            });
        });

        function setSubjectSession(subjectId) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "set_subject_session.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log("Session subject ID set to: " + subjectId);
                    // Redirect to the details page after setting the session
                    window.location.href = 'adminPenggunadetailjawaban2.php';
                }
            };
            xhr.send("subject_id=" + subjectId);
        }
    </script>
</body>

</html>

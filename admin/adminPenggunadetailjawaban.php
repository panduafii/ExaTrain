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
                <div class="year-buttons">
                    <button class="year-button" data-year="2023">2023</button>
                    <button class="year-button" data-year="2022">2022</button>
                    <button class="year-button" data-year="2021">2021</button>
                </div>
                <div class="courses" id="courses-container">
                    <!-- Courses will be dynamically inserted here -->
                </div>
            </div>
        </div>
    </div>

    <script>
    // Menangani perubahan tampilan mata kuliah berdasarkan tahun yang dipilih
    document.addEventListener("DOMContentLoaded", () => {
        const yearButtons = document.querySelectorAll(".year-button");
        const coursesContainer = document.getElementById("courses-container");

        const courses = {
            2023: [
                { id: 7, name: "Matematika Lanjut", img: "../img/matlan.png" },
                { id: 8, name: "Algoritma dan Struktur Data", img: "../img/asd.png" },
                { id: 9, name: "Fundamen Pengembangan Aplikasi", img: "../img/fpa.png" },
                { id: 10, name: "Rekayasa Perangkat Lunak", img: "../img/rpl.png" },
            ],
            2022: [
                { id: 1, name: "Pengembangan Sistem Informasi", img: "../img/psi.png" },
                { id: 2, name: "Grafika dan Multimedia", img: "../img/grafmul.png" },
                { id: 3, name: "Sistem Cerdas dan Pendukung Keputusan", img: "../img/scpk.png" },
                { id: 4, name: "Bahasa Indonesia Komunikasi Ilmiah", img: "../img/bindo.png" },
                { id: 5, name: "Bahasa Inggris Teknologi Informasi", img: "../img/bingris.png" },
                { id: 6, name: "Islam Ulil Albab", img: "../img/islam.png" },
            ],
            2021: [
                { id: 11, name: "Islam Rahmatan lil 'Alamin", img: "../img/iru.png" },
                { id: 12, name: "Etika Profesi", img: "../img/profesi.png" },
            ],
        };

        function displayCourses(year) {
            coursesContainer.innerHTML = "";
            courses[year].forEach((course) => {
                const form = document.createElement("form");
                form.onsubmit = function(event) {
                    event.preventDefault();
                    setSubjectSession(course.id);
                };

                const courseButton = document.createElement("button");
                courseButton.className = "course-button";
                courseButton.type = "submit";

                const courseImg = document.createElement("img");
                courseImg.src = course.img;
                courseImg.alt = course.name;

                const courseName = document.createElement("span");
                courseName.textContent = course.name;

                courseButton.appendChild(courseImg);
                courseButton.appendChild(courseName);

                form.appendChild(courseButton);
                coursesContainer.appendChild(form);
            });
        }

        yearButtons.forEach((button) => {
            button.addEventListener("click", () => {
                yearButtons.forEach((btn) => btn.classList.remove("active"));
                button.classList.add("active");
                displayCourses(button.dataset.year);
            });
        });

        // Initial display
        displayCourses("2022");

        function setSubjectSession(subjectId) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "set_subject_session.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    window.location.href = 'adminPenggunadetailjawaban2.php';
                }
            };
            xhr.send("subject_id=" + subjectId);
        }
    });
</script>

</body>
</html>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selected_course_id'])) {
    $selectedCourseId = $_POST['selected_course_id'];

    // Simpan selected_course_id di dalam session
    $_SESSION['selected_course_id'] = $selectedCourseId;

    // Redirect ke halaman EvaluasiSoal.php
    header('Location: EvaluasiSoal.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pilihan Mata Kuliah</title>
    <link rel="stylesheet" href="CSS/pilihanMatkul.css" />
</head>
<body style="background-image: url('img/background.png'); background-size: cover; background-repeat: no-repeat;">
    <!-- Navbar -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="img/logo.png" alt="Logo" />
            </div>
            <ul class="menu">
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Mata Kuliah</a></li>
                <li><a href="#">Papan Peringkat</a></li>
                <li><a href="#">Tentang Kami</a></li>
                <li>
                    <?php
                    // Menampilkan nama pengguna jika ada yang masuk
                    if (isset($_SESSION["username"])) {
                        $username = $_SESSION["username"];
                        echo "Hi! $username";
                    } else {
                        echo "Hi!";
                    }
                    ?>
                </li>
                <li><a href="#"><img src="img/avatar.png" alt="User" class="user-icon"></a></li>
            </ul>
            <div class="menu-toggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </nav>
    </header>
    <!-- End Navbar -->

    <!-- Tombol Back -->
    <div class="back-button" onclick="goBack(dashboard.php)">
        <a href="dashboard.php">&larr;</a>
    </div>
    <!-- End -->

    <!-- Pilihan Matkul -->
    <div class="container">
        <strong><h1>Pilihan Mata Kuliah</h1></strong>
        <div class="year-buttons">
            <button id="2023" class="year-button">2023</button>
            <button id="2022" class="year-button active">2022</button>
            <button id="2021" class="year-button">2021</button>
        </div>
        <div class="courses" id="courses-container">
            <!-- Courses will be dynamically inserted here -->
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back("dashboard.php");
        }

        document.addEventListener("DOMContentLoaded", () => {
            const yearButtons = document.querySelectorAll(".year-button");
            const coursesContainer = document.getElementById("courses-container");

            const courses = {
                2023: [
                    { id: 7, name: "Matematika Lanjut", img: "img/matlan.png" },
                    { id: 8, name: "Algoritma dan Struktur Data", img: "img/asd.png" },
                    { id: 9, name: "Fundamen Pengembangan Aplikasi", img: "img/fpa.png" },
                    { id: 10, name: "Rekayasa Perangkat Lunak", img: "img/rpl.png" },
                ],
                2022: [
                    { id: 1, name: "Pengembangan Sistem Informasi", img: "img/psi.png" },
                    { id: 2, name: "Grafika dan Multimedia", img: "img/grafmul.png" },
                    { id: 3, name: "Sistem Cerdas dan Pendukung Keputusan", img: "img/scpk.png" },
                    { id: 4, name: "Bahasa Indonesia Komunikasi Ilmiah", img: "img/bindo.png" },
                    { id: 5, name: "Bahasa Inggris Teknologi Informasi", img: "img/bingris.png" },
                    { id: 6, name: "Islam Ulil Albab", img: "img/islam.png" },
                ],
                2021: [
                    { id: 11, name: "Islam Rahmatan lil 'Alamin", img: "img/iru.png" },
                    { id: 12, name: "Etika Profesi", img: "img/profesi.png" },
                ],
            };

            function displayCourses(year) {
                coursesContainer.innerHTML = "";
                courses[year].forEach((course) => {
                    const form = document.createElement("form");
                    form.action = "pilihanMatkul.php";
                    form.method = "post";

                    const courseButton = document.createElement("button");
                    courseButton.className = "course-button";
                    courseButton.name = "selected_course_id";
                    courseButton.value = course.id;

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
                    displayCourses(button.id);
                });
            });

            // Initial display
            displayCourses("2022");
        });
    </script>
</body>
</html>

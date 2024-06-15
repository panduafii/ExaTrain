<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="CSS/profiluser.css">
</head>

<body>
    <div class="container">
        <nav class="navbar">
            <img src="img/logo1.png" alt="EXATrain Logo" class="navbar-logo">
        </nav>
        <button class="back-button">←</button>
        <div class="bungkus">
            <div class="profile">
                <div class="profile-header">
                    <img src="img/profile-picture.png" alt="User">
                    <span class="user-name">User</span>
                </div>
                <button class="edit-profile-button">
                    <img src="img/editicon.png" alt="Edit Icon" class="button-icon">
                    <span>Edit Profile</span>
                </button>
                <table>
                    <tr>
                        <td>ID:</td>
                        <td>6797524</td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td>Vale2sulap</td>
                    </tr>
                    <tr>
                        <td>Angkatan:</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td>**********</td>
                    </tr>
                    <tr>
                        <td>Phone:</td>
                        <td>08xxxxxxxx</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><img src="icon-email.png" alt="Email Icon" class="icon-email"> vale2sulap21@gmail.com</td>
                    </tr>
                </table>
                <button class="logout-button">
                    <img src="img/logout-hitam.png" alt="Edit Icon" class="button-icon-logout">
                    <span>Logout</span>
                </button>
            </div>
            <div class="content">
                <div class="sticky-title">
                    <h3>Data dan Statistik</h3>
                </div>
                <div class="chart-container">
                    <div class="chart">
                        <h3>Pengerjaan Mata Kuliah</h3>
                        <div class="chart-content" id="chart1"></div>
                    </div>
                    <div class="chart">
                        <h3>Salah dan Benar</h3>
                        <div class="chart-content" id="chart2"></div>
                    </div>
                    <div class="chart">
                        <h3>Rata - Rata Nilai Seluruh Mata Kuliah Tiap Periode</h3>
                        <div class="chart-content" id="chart3"></div>
                    </div>
                    <div class="chart">
                        <h3>Rata-Rata Nilai Tiap Mata Kuliah</h3>
                        <div class="chart-content" id="chart4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

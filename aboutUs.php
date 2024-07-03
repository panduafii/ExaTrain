<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="CSS/aboutUs.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="img/logo.png" alt="Exatrain Logo" />
        </div>
        <ul class="menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="pilihanMatkul.php">Mata Kuliah</a></li>
                <li><a href="paring.php">Papan Peringkat</a></li>
                <li><a href="aboutUs.php">Tentang Kami</a></li>
                <li>Hi! <?= isset($_SESSION["username"]) ? $_SESSION["username"] : "Guest"; ?></li>
                <li><a href="profil.php"><img src="img/avatar.png" alt="User" class="user-icon"></a></li>
            </ul>
    </nav>
    <header class="header">
        <h1>About Us</h1>
        <img src="img/picture1.png" alt="Background Header Image">
    </header>

    <section class="project">
        <div class="project-content">
            <h2>Our Project</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In lacinia ac mi ac sollicitudin. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <p>Integer et dui gravida diam vehicula condimentum at et dui. Vestibulum luctus justo sit amet velit venenatis, id tincidunt nunc iaculis.</p>
        </div>
        <div class="project-image">
            <img src="img/project-image.jpg" alt="Project Image">
        </div>
    </section>

    <section class="services">
        <h2>Our Services</h2>
        <div class="services-container">
            <div class="service">
                <h3>TRY OUT</h3>
                <p>Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="service">
                <h3>AI CHECK</h3>
                <p>Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="service">
                <h3>DETAIL</h3>
                <p>Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="service">
                <h3>RANKING</h3>
                <p>Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="service">
                <h3>PROGRESS</h3>
                <p>Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
    </section>

    <section class="team">
        <h2>Meet Our Team</h2>
        <div class="team-container">
            <div class="team-member">
                <img src="img/team-member1.jpg" alt="Team Member 1">
                <h3>Alex Example</h3>
            </div>
            <div class="team-member">
                <img src="img/team-member2.jpg" alt="Team Member 2">
                <h3>Alex Example</h3>
            </div>
            <div class="team-member">
                <img src="img/team-member3.jpg" alt="Team Member 3">
                <h3>Alex Example</h3>
            </div>
            <div class="team-member">
                <img src="img/team-member4.jpg" alt="Team Member 4">
                <h3>Kate Example</h3>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Exatrain</h3>
            </div>
            <div class="footer-section">
                <h3>About</h3>
            </div>
            <div class="footer-section">
                <h3>Company</h3>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
            </div>
        </div>
    </footer>
</body>
</html>

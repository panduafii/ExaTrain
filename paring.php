<?php
$host = 'localhost';  // Host database
$dbname = 'ExaTrain';  // Nama database
$username = 'root';  // Username database
$password = 'root';  // Password database

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT u.username, COALESCE(SUM(a.is_correct), 0) AS total_correct
                         FROM users u
                         LEFT JOIN answers a ON u.id = a.user_id AND a.is_correct = 1
                         GROUP BY u.username
                         ORDER BY total_correct DESC, u.username");
    
    $rankings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Papan Peringkat</title>
    <link rel="stylesheet" href="CSS/paring.css" />
  </head>
  <body>
    <!-- Navbar -->
    <header>
    <nav class="navbar">
            <div class="logo">
                <img src="img/logo.png" alt="Logo" />
            </div>
            <ul class="menu">
                <li><a href="landingPage.php">Beranda</a></li>
                <li><a href="pilihanMatkul.php">Mata Kuliah</a></li>
                <li><a href="paring.php">Papan Peringkat</a></li>
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
                    <a href="profil.php"><img src="img/avatar.png" alt="User" class="user-icon"></a>
                </li>
                <!-- <li></li> -->
            </ul>
            <div class="menu-toggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </nav>
    </header>
    <!-- End -->

     <!-- Tombol Back -->
     <div class="back-button" onclick="goBack()">
      <a href="#">&larr;</a>
    </div>
    <!-- End -->

    <!-- Container -->
    <div class="container">
    <h1>Papan Peringkat</h1>
    <div class="leaderboard">
        <?php
        $index = 0;
        foreach ($rankings as $row):
            $index++;
            $stars = '';
            if ($index == 1) {
                $stars = '⭐⭐⭐';  // 3 bintang untuk peringkat 1
            } elseif ($index == 2) {
                $stars = '⭐⭐';   // 2 bintang untuk peringkat 2
            } elseif ($index == 3) {
                $stars = '⭐';    // 1 bintang untuk peringkat 3
            }
        ?>
        <div class="leaderboard-item">
            <span class="rank"><?= $index ?></span>
            <span class="username"><?= htmlspecialchars($row['username']) ?></span>
            <span class="stars"><?= $stars ?></span>
            <span class="score"><?= $row['total_correct'] ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</div>



    <script>
      function goBack() {
        window.history.back();
      }
    </script>
  </body>
</html>

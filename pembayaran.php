<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="CSS/pembayaran.css" />
    <title>Pembayaran</title>
  </head>
  <body style="background-image: url('img/background.png'); background-size: cover; background-repeat: no-repeat;">
    <!-- NAVBAR -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="img/logo.png" alt="Logo" />
            </div>
            <ul class="menu">
                <li><a href="dashboard.php">Dashboard</a></li>
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
                </li>
                <li><a href="profil.php"><img src="img/avatar.png" alt="User" class="user-icon"></a></li>
                <!-- <li></li> -->
            </ul>
            <div class="menu-toggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </nav>
    </header>
    <!-- end navbar -->

    <!-- Tombol Back -->
    <div class="back-button" onclick="goBack()">
      <a href="#">&larr;</a>
    </div>
    <!-- End -->

    <!-- Pembayaran -->
    <div class="container">
      <h1>Konfirmasi Pembayaran</h1>
      <div class="payment-box">
        <div class="package">
          <p>Paket Kamu</p>
          <div class="price">Rp 11.999 / 6 Bulan</div>
        </div>
        <div class="payment-method">
          <label> <input type="radio" name="payment" value="bank" /> Transfer Bank </label>
          <label> <input type="radio" name="payment" value="ewallet" /> E-Wallet </label>
          <label> <input type="radio" name="payment" value="mbanking" /> M-Banking </label>
        </div>
        <button class="confirm-button">Konfirmasi</button>
      </div>
    </div>
    <!-- End -->

    <!-- Back button -->
    <script>
      function goBack() {
        window.history.back();
      }
    </script>
    <!-- End -->
  </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="CSS/loginRegist.css" />
    <title>Login and Register</title>
</head>
<body style="background-image: url('img/background.png'); background-repeat:no-repeat; background-size:cover;">
    
    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo">
            <img src="img/logo.png" alt="Logo" />
        </div>
        <ul class="menu">
            <li><a href="landingPage.php">Beranda</a></li>
            <li><a href="pilihanMatkul.php">Mata Kuliah</a></li>
            <li><a href="paring.php">Papan Peringkat</a></li>
            <li><a href="#">Tentang Kami</a></li>
            <li><button>Sign Up</button></li>
        </ul>
    </nav>

    <!-- LOGIN DAN REGISTER -->
    <div class="login-page">
        <div class="form">
            <form class="register-form" action="fungsiPHP/add_user.php" method="post">
              <div class="register-container">
                <!-- Pembayaran -->
                <div class="payment">
                <h3>Paket Kamu</h3>
                  <p>Rp 11.999 / 6 Bulan</p>
                      <input type="radio" name="payment-method" value="bank-transfer" />
                        <label for="payment1"> Transfer Bank</label><br>
                      <input type="radio" name="payment-method" value="e-wallet" />
                        <label for="payment2"> E-Wallet</label><br>
                      <input type="radio" name="payment-method" value="m-banking" />
                        <label for="payment3">M-Banking</label><br>
                  <button type="button">Konfirmasi</button>
                </div>
                <!-- Vertical Divider -->
                <div class="vertical-divider"></div> 
                 <!-- Register --> 
                <div class="registrasi">
                  <h2>Register</h2>
                  <input type="text" placeholder="Name" required/>
                  <input type="password" placeholder="Password" required/>
                  <button type="submit">Create Account</button>
                  <p class="message">Already registered? <a href="#">Sign In</a></p>
                </div>
              </div>
            </form>

            <!-- Login -->
            <form class="login-form" action="fungsiPHP/login.php" method="post">
              <div class="login-container">
                <!-- LOGIN -->
                <div class="login">
                  <h2>Login Page</h2>
                  <input type="text" id="username" name="username" placeholder="username" required><br><br>
                  <input type="password" id="password" name="password" placeholder="password" required><br><br>
                  <button class="login-button" type="submit" name="submit">Login</button>
                  <p class="message">Not registered? <a href="#">Create an account</a></p>
                  <button class="admin-button">I'm admin</button>
                </div>

                <!-- Vertical Divider -->
                <div class="vertical-divider"></div> 

                <!-- picture -->
                <div class="picture">
                  <img src="img/landingpage1.jpg" alt="">
                </div>
              </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="JS/login.js"></script>
</body>
</html>

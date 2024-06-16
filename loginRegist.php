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
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Mata Kuliah</a></li>
            <li><a href="#">Papan Peringkat</a></li>
            <li><a href="#">Tentang Kami</a></li>
            <li><button>Sign Up</button></li>
        </ul>
    </nav>

    <!-- LOGIN DAN REGISTER -->
    <div class="login-page">
        <div class="form">
            <form class="register-form">
              <!-- Pembayaran -->
              <div class="payment">
              <h3>Paket Kamu</h3>
                <p>Rp 11.999 / 6 Bulan</p>
                <label>
                    <input type="radio" name="payment-method" value="bank-transfer" />
                    Transfer Bank
                </label>
                <label>
                    <input type="radio" name="payment-method" value="e-wallet" />
                    E-Wallet
                </label>
                <label>
                    <input type="radio" name="payment-method" value="m-banking" />
                    M-Banking
                </label>
                <button>Konfirmasi</button>
              </div>
              <div class="registrasi">
                <!-- Register -->
                <h2>Register</h2>
                <input type="text" placeholder="Name" />
                <input type="password" placeholder="Password" />
                <button type="submit">Create Account</button>
                <p class="message">Already registered? <a href="#">Sign In</a></p>
              </div>
            </form>
            <!-- Login -->
            <form class="login-form">
                <h2>Login Page</h2>
                <input type="text" placeholder="username" />
                <input type="password" placeholder="password" />
                <button class="login-button">login</button>
                <p class="message">Not registered? <a href="#">Create an account</a></p>
                <button class="admin-button">I'm admin</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="JS/login.js"></script>
</body>
</html>
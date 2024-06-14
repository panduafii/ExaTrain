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
<<<<<<< HEAD
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
                <input type="text" placeholder="E-mail" />
                <input type="text" placeholder="Phone" />
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
=======
      <div class="form">
        <!-- Register -->
        <form class="register-form" action="fungsiPHP/add_user.php" method="post">
          <h2>Register</h2>
          <!-- <label for="username">Username:</label><br> -->
          <input type="text" id="username" name="username" placeholder="username" required><br><br>

          <!-- <label for="password">Password:</label><br> -->
          <input type="password" id="password" name="password" required><br><br>

          <button type="submit" name="submit">Tambah Pengguna</button>
          <p class="message">Belum Punya Akun? <a href="#">Sign In</a></p>
        </form>
        
        <!-- Login -->
        <form class="login-form" action="fungsiPHP/login.php" method="post">
          <h2>Login Page</h2>
          <!-- <label for="username">Username:</label><br> -->
          <input type="text" id="username" name="username" placeholder="username" required><br><br>

          <!-- <label for="password">Password:</label><br> -->
          <input type="password" id="password" name="password" placeholder="password" required><br><br>

          <button class="login-button" type="submit" name="submit">Login</button>

          <p class="message">Not registered? <br> <a href="#">Create an account</a></p>
          <button class="admin-button">I'm admin</button>
        </form>
      </div>
>>>>>>> c326ab2be7762cd232ab00b681cf29e40f818420
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="JS/login.js"></script>
</body>
</html>

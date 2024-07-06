<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="CSS/loginRegist.css" />
    <title>Login and Register</title>
</head>
<body style="background-image: url('img/background.png'); background-repeat:no-repeat; background-size:cover; background-attachment: fixed;">

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo">
            <img src="img/logo.png" alt="Logo" />
        </div>
        <input type="checkbox" id="menu-toggle" class="menu-toggle" hidden>
        <ul class="menu">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="">Mata Kuliah</a></li>
            <li><a href="">Papan Peringkat</a></li>
            <li><a href="aboutUs.php">Tentang Kami</a></li>
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
                <div class="credit-card-button" onclick="selectPaymentMethod(this)">
                        <img src="img/transfer.png" alt="Tranfer" class="icon">
                        <span>Tranfer</span>
                        <div class="checkmark">&#10003;</div>
                    </div>
                    <div class="credit-card-button" onclick="selectPaymentMethod(this)">
                        <img src="img/m_banking.png" alt="M-Banking" class="icon">
                        <span>M-Banking</span>
                        <div class="checkmark">&#10003;</div>
                    </div>
                    <div class="credit-card-button" onclick="selectPaymentMethod(this)">
                        <img src="img/e_wallet.png" alt="E-Wallet" class="icon">
                        <span>E-Wallet</span>
                        <div class="checkmark">&#10003;</div>
                    </div>
                </div>
                <!-- Vertical Divider -->
                <div class="vertical-divider"></div> 
                 <!-- Register --> 
                <div class="registrasi">
                  <h2>Register</h2>
                  <input type="text" id="username" name="username" placeholder="username" required><br><br>
                  <!-- <label for="password">Password:</label><br> -->
                  <input type="password" id="password" name="password" placeholder="password" required><br><br>
                <select name="angkatan" required>
                    <option value="">Pilih Angkatan</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                </select><br>
                  <button type="submit" name="submit">Tambah Pengguna</button>
                  <p class="message">Sudah Punya Akun?<a href="#">Log In</a></p>
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
                  <p class="message">Belum Punya Akun? <a href="#">Create an account</a></p>
                  <button class="admin-button" onclick="location.href='admin/adminPengguna.php'">I'm admin</button>
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
    <script> function selectPaymentMethod(element) {
            const methods = document.querySelectorAll('.credit-card-button');
            methods.forEach(method => method.classList.remove('selected'));
            element.classList.add('selected');
        }</script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="JS/login.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="CSS/loginRegist.css" />
    <title>Login and Register</title>
  </head>
  <body>
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
        <!-- Register -->
        <form class="register-form" action="fungsiPHP/add_user.php" method="post">
          <label for="username">Username:</label><br>
          <input type="text" id="username" name="username" required><br><br>

          <label for="password">Password:</label><br>
          <input type="password" id="password" name="password" required><br><br>

          <button type="submit" name="submit">Tambah Pengguna</button>
          <p class="message">Already registered? <a href="#">Sign In</a></p>
        </form>
        <!-- Login -->
        <form class="login-form" action="fungsiPHP/login.php" method="post">
          <label for="username">Username:</label><br>
          <input type="text" id="username" name="username" required><br><br>

          <label for="password">Password:</label><br>
          <input type="password" id="password" name="password" required><br><br>

          <button type="submit" name="submit">Login</button>
          <p class="message">Not registered? <a href="#">Create an account</a></p>
        </form>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="JS/login.js"></script>
  </body>
</html>

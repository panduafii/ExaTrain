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
        <form class="register-form">
          <h2>Register</h2>
          <input type="text" placeholder="name" />
          <input type="password" placeholder="password" />
          <input type="text" placeholder="email address" />
          <button>create</button>
          <p class="message">Already registered? <a href="#">Sign In</a></p>
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

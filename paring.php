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
    <nav class="navbar">
      <div class="logo">
        <img src="img/logo.png" alt="Logo" />
      </div>
      <ul class="menu">
        <li><a href="#">Beranda</a></li>
        <li><a href="#">Mata Kuliah</a></li>
        <li><a href="#">Papan Peringkat</a></li>
        <li><a href="#">Tentang Kami</a></li>
        <li><a href="#"><img src="img/avatar.png" alt="User" class="user-icon"></a></li>
      </ul>
    </nav>

    <!-- Container -->
    <div class="container">
      <button class="back-button" onclick="goBack()">&#8592;</button>
      <h1>Papan Peringkat</h1>
      <div class="leaderboard">
        <button class="leaderboard-item">
          <span class="rank">1</span>
          <span class="username">Dudut Simalakama</span>
          <span class="stars">⭐⭐⭐</span>
          <span class="score">98/100</span>
        </button>
        <button class="leaderboard-item">
          <span class="rank">2</span>
          <span class="username">Combro Misro</span>
          <span class="stars">⭐⭐</span>
          <span class="score">96/100</span>
        </button>
        <button class="leaderboard-item">
          <span class="rank">3</span>
          <span class="username">Kamikamukamis</span>
          <span class="stars">⭐</span>
          <span class="score">95/100</span>
        </button>
        <button class="leaderboard-item">
          <span class="rank">4</span>
          <span class="username">John Keller</span>
          <span class="score">88/100</span>
        </button>
        <button class="leaderboard-item">
          <span class="rank">5</span>
          <span class="username">Cimong</span>
          <span class="score">86/100</span>
        </button>
      </div>
    </div>

    <script>
      function goBack() {
        window.history.back();
      }
    </script>
  </body>
</html>

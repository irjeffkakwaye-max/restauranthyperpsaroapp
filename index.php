<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Accueil - Hyper Psaro</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: url("assets/hyperpsaro.jpg") no-repeat center center fixed;
      background-size: cover;
    }

    /* Navbar */
    .navbar {
      background: rgba(0,0,0,0.8);
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .navbar h2 { color: #ff6600; margin: 0; }
    .navbar a {
      background: #ff6600;
      color: #fff;
      padding: 10px 18px;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
      transition: background 0.3s;
      margin-left: 5px;
    }
    .navbar a:hover { background: #cc5200; }

    /* Slider */
    .slider {
      width: 100%;
      max-height: 300px;
      overflow: hidden;
      position: relative;
      margin-top: 10px;
    }
    .slides {
      display: flex;
      width: 400%; /* 4 images */
      animation: slide 16s infinite;
    }
    .slides img {
      width: 100%;
      max-height: 300px;
      object-fit: cover;
    }
    @keyframes slide {
      0%   { transform: translateX(0); }
      20%  { transform: translateX(0); }
      25%  { transform: translateX(-100%); }
      45%  { transform: translateX(-100%); }
      50%  { transform: translateX(-200%); }
      70%  { transform: translateX(-200%); }
      75%  { transform: translateX(-300%); }
      95%  { transform: translateX(-300%); }
      100% { transform: translateX(0); }
    }

    /* Container */
    .container {
      text-align: center;
      margin-top: 40px;
      background: rgba(255,255,255,0.85);
      padding: 30px;
      border-radius: 10px;
      width: 60%;
      margin-left: auto;
      margin-right: auto;
    }
    h1 { color: #ff6600; }
    .menu a {
      display: inline-block;
      margin: 15px;
      padding: 15px 25px;
      background: #ff6600;
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      transition: background 0.3s;
    }
    .menu a:hover { background: #cc5200; }
  </style>
</head>
<body>
  <!-- Navbar -->
  <div class="navbar">
    <h2>Hyper Psaro</h2>
    <div>
      <a href="index.php">Accueil</a>
      <a href="reserve.php">Réservation</a>
      <a href="commande.php">Commande</a>
      <a href="menu.php">Menu</a>
      <a href="admin.php">Admin</a>
    </div>
  </div>

  <!-- Slider -->
  <div class="slider">
    <div class="slides">
      <img src="assets/pub1.jpg" alt="Promo 1">
      <img src="assets/pub2.jpg" alt="Promo 2">
      <img src="assets/pub3.jpg" alt="Promo 3">
      <img src="assets/pub4.jpg" alt="Promo 4">
    </div>
  </div>

  <!-- Contenu principal -->
  <div class="container">
    <h1>Bienvenue chez Hyper Psaro</h1>
    <p>Choisissez une action :</p>
    <div class="menu">
      <a href="reserve.php">Faire une réservation</a>
      <a href="commande.php">Passer une commande</a>
      <a href="admin.php">Administration</a>
    </div>
  </div>
</body>
</html>

<?php
session_start();

// Vérifie si l'admin est connecté
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Connexion à la base
$conn = new mysqli("localhost", "root", "", "restaurant_db");
if ($conn->connect_error) {
    die("Erreur connexion: " . $conn->connect_error);
}

// --- Réservations ---
$sqlResa = "SELECT r.ID_Resa, r.dateResa, r.heure, r.nbPersonnes, c.nom, c.telephone
            FROM reservation r
            JOIN client c ON r.id_client = c.id_client
            ORDER BY r.dateResa DESC";
$reservations = $conn->query($sqlResa);

// --- Commandes ---
$sqlCmd = "SELECT ID_Commande, id_resa, id_menu, quantite FROM commandes ORDER BY ID_Commande DESC";
$commandes = $conn->query($sqlCmd);

$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Administration</title>
  <style>
    body { font-family: Arial, sans-serif; background: #fff; margin: 0; }
    .navbar { background: #000; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
    .navbar h2 { color: #ff6600; margin: 0; }
    .navbar a { background: #ff6600; color: #fff; padding: 10px 18px; text-decoration: none; border-radius: 5px; font-weight: bold; transition: background 0.3s; margin-left: 10px; }
    .navbar a:hover { background: #cc5200; }
    .container { background: #fff; border: 2px solid #000; border-radius: 10px; width: 90%; padding: 30px; margin: 40px auto; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
    h1 { text-align: center; color: #ff6600; margin-bottom: 20px; }
    h2 { color: #ff6600; margin-top: 30px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #000; padding: 10px; text-align: center; }
    th { background: #ff6600; color: #fff; }
  </style>
</head>
<body>
  <div class="navbar">
    <h2>Hyper Psaro</h2>
    <div>
      <a href="index.php">Accueil</a>
      <a href="reserve.php">Réservation</a>
      <a href="commande.php">Commande</a>
      <a href="menu.php">Menu</a>
      <a href="logout.php">Déconnexion</a> <!-- ✅ bouton logout -->
    </div>
  </div>

  <div class="container">
    <h1>Administration - Réservations et Commandes</h1>

    <h2>Réservations</h2>
    <table>
      <tr>
        <th>ID</th><th>Date</th><th>Heure</th><th>Nb personnes</th><th>Nom</th><th>Téléphone</th>
      </tr>
      <?php if ($reservations && $reservations->num_rows > 0): ?>
        <?php while($row = $reservations->fetch_assoc()): ?>
          <tr>
            <td><?= $row['ID_Resa'] ?></td>
            <td><?= $row['dateResa'] ?></td>
            <td><?= $row['heure'] ?></td>
            <td><?= $row['nbPersonnes'] ?></td>
            <td><?= $row['nom'] ?></td>
            <td><?= $row['telephone'] ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="6">Aucune réservation trouvée</td></tr>
      <?php endif; ?>
    </table>

    <h2>Commandes</h2>
    <table>
      <tr>
        <th>ID</th><th>ID Réservation</th><th>Plat (id_menu)</th><th>Quantité</th>
      </tr>
      <?php if ($commandes && $commandes->num_rows > 0): ?>
        <?php while($row = $commandes->fetch_assoc()): ?>
          <tr>
            <td><?= $row['ID_Commande'] ?></td>
            <td><?= $row['id_resa'] ?></td>
            <td><?= $row['id_menu'] ?></td>
            <td><?= $row['quantite'] ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="4">Aucune commande trouvée</td></tr>
      <?php endif; ?>
    </table>
  </div>
</body>
</html>

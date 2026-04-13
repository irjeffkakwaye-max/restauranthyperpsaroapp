<?php
session_start();

// Vérifie si l'admin est connecté (optionnel si tu veux protéger aussi commande.php)
if (!isset($_SESSION['admin_logged_in'])) {
    // header("Location: login.php");
    // exit;
}

// Connexion à la base
$conn = new mysqli("localhost", "root", "", "restaurant_db");
if ($conn->connect_error) {
    die("Erreur connexion: " . $conn->connect_error);
}

// Vérifie si un plat a été sélectionné depuis menu.php
$selectedMenu = null;
if (isset($_GET['id_menu'])) {
    $id_menu = intval($_GET['id_menu']);
    $sql = "SELECT NomPlat, Prix FROM menu WHERE ID_Menu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_menu);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $selectedMenu = $result->fetch_assoc();
    }
    $stmt->close();
}

// Traitement du formulaire de commande
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_menu = intval($_POST['id_menu']);
    $quantite = intval($_POST['quantite']);
    $id_resa = intval($_POST['id_resa']); // si tu veux lier à une réservation

    $sqlInsert = "INSERT INTO commandes (id_resa, id_menu, quantite) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sqlInsert);
    $stmt->bind_param("iii", $id_resa, $id_menu, $quantite);

    if ($stmt->execute()) {
        $message = "Commande enregistrée avec succès !";
    } else {
        $message = "Erreur lors de l'enregistrement : " . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Passer une commande</title>
  <style>
    body { font-family: Arial, sans-serif; background: #fff; margin: 0; }
    .container { width: 60%; margin: 50px auto; padding: 30px; border: 2px solid #000; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
    h1 { text-align: center; color: #ff6600; }
    label { display: block; margin-top: 15px; font-weight: bold; }
    input, select, button { width: 100%; padding: 10px; margin-top: 5px; border-radius: 6px; border: 1px solid #ccc; }
    button { background: #ff6600; color: #fff; font-weight: bold; cursor: pointer; transition: background 0.3s; }
    button:hover { background: #cc5200; }
    .message { margin-top: 15px; color: green; font-weight: bold; text-align: center; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Passer une commande</h1>
    <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>
    <form method="post">
      <!-- Plat pré-rempli -->
      <label>Plat :</label>
      <input type="text" value="<?= $selectedMenu ? $selectedMenu['NomPlat'] : '' ?>" readonly>
      <input type="hidden" name="id_menu" value="<?= isset($_GET['id_menu']) ? intval($_GET['id_menu']) : '' ?>">

      <!-- Quantité -->
      <label>Quantité :</label>
      <input type="number" name="quantite" min="1" required>

      <!-- Réservation liée (optionnel) -->
      <label>ID Réservation :</label>
      <input type="number" name="id_resa" min="1" required>

      <button type="submit">Valider la commande</button>
      <div style="text-align:center; margin-top:20px;">
  <a href="menu.php" 
     style="display:inline-block; padding:10px 20px; background:#ff6600; color:#fff; 
            text-decoration:none; border-radius:6px; font-weight:bold; transition:background 0.3s;">
     Retour au Menu
  </a>
</div>
    </form>
  </div>
</body>
</html>

<?php
session_start();
$conn = new mysqli("localhost", "root", "", "restaurant_db");
if ($conn->connect_error) {
    die("Erreur connexion: " . $conn->connect_error);
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Vérifier si l'utilisateur existe
    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Vérifie le mot de passe hashé
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $row['username'];
            header("Location: admin.php"); // ✅ redirection vers admin.php
            exit;
        } else {
            $error = "Mot de passe incorrect";
        }
    } else {
        $error = "Utilisateur introuvable";
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion Admin</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #ff6600, #000);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .login-box {
      background: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.3);
      width: 350px;
      text-align: center;
    }
    h2 { margin-bottom: 20px; color: #ff6600; }
    input[type="text"], input[type="password"] {
      width: 100%; padding: 12px; margin: 10px 0;
      border: 1px solid #ccc; border-radius: 6px;
    }
    button {
      width: 100%; padding: 12px;
      background: #ff6600; color: #fff;
      border: none; border-radius: 6px;
      font-weight: bold; cursor: pointer;
      transition: background 0.3s ease;
    }
    button:hover { background: #cc5200; }
    .error { color: red; margin-bottom: 15px; }
    .signup-link { margin-top: 15px; }
    .signup-link a {
      color: #ff6600; text-decoration: none; font-weight: bold;
    }
    .signup-link a:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Connexion Administrateur</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
      <input type="text" name="username" placeholder="Nom d'utilisateur" required>
      <input type="password" name="password" placeholder="Mot de passe" required>
      <button type="submit">Se connecter</button>
    </form>
    <div class="signup-link">
      <p>Pas encore inscrit ? <a href="signup.php">Créer un compte</a></p>
    </div>
    <div style="text-align:center; margin-top:20px;">
  <a href="index.php" 
     style="display:inline-block; padding:10px 20px; background:#ff6600; color:#fff; 
            text-decoration:none; border-radius:6px; font-weight:bold; transition:background 0.3s;">
    Retour
  </a>
</div>
  </div>
</body>
</html>

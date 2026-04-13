<?php
// Connexion à la base
$conn = new mysqli("localhost", "root", "", "restaurant_db");
if ($conn->connect_error) {
    die("Erreur connexion: " . $conn->connect_error);
}

// Récupération des données POST avec protection
$id_client   = (int) $_POST['id_client'];
$note        = (int) $_POST['note'];
$commentaire = $conn->real_escape_string($_POST['commentaire']);

// Vérification de la note
if ($note < 1 || $note > 5) {
    header("Location: /restaurant-reservation/admin.php?error=avis");
    exit();
}

// Préparer la requête pour éviter les injections SQL
$stmt = $conn->prepare("INSERT INTO Avis_Client (ID_Client, Note, Commentaire) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $id_client, $note, $commentaire);

if ($stmt->execute()) {
    header("Location: /restaurant-reservation/admin.php?success=avis");
    exit();
} else {
    header("Location: /restaurant-reservation/admin.php?error=avis");
    exit();
}

$stmt->close();
$conn->close();
?>

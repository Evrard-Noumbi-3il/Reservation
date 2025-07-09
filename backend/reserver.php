<?php
require_once('../config/db.php');

$nom = htmlspecialchars($_POST['nom']);
$nom_evenement = htmlspecialchars($_POST['nom_evenement']);
$date = $_POST['date'];
$heure = $_POST['heure'];

$sql = "SELECT COUNT(*) FROM reservations WHERE date = ? AND heure = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$date, $heure]);
$existe = $stmt->fetchColumn();

if ($existe > 0) {
    echo "Créneau déjà réservé.";
    exit;
}

$sql = "INSERT INTO reservations (nom, nom_evenement, date, heure) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nom, $nom_evenement, $date, $heure]);

echo "Réservation réussie ! <a href='../index.php'>Retour</a>";
?>

<?php
session_start();
require_once('../config/connexion.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit;
}

if (
    empty($_POST['csrf_token']) ||
    !isset($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    header("Location: ../index.php?erreur=csrf");
    exit;
}

$nom           = trim($_POST['nom'] ?? '');
$nom_evenement = trim($_POST['nom_evenement'] ?? '');
$date          = $_POST['date'] ?? '';
$heure         = $_POST['heure'] ?? '';

if (!$nom || !$nom_evenement || !$date || !$heure) {
    header("Location: ../index.php?erreur=champs");
    exit;
}

if (strlen($nom) > 100 || strlen($nom_evenement) > 100) {
    header("Location: ../index.php?erreur=champs");
    exit;
}

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date) || !strtotime($date)) {
    header("Location: ../index.php?erreur=date");
    exit;
}

if (!preg_match('/^\d{2}:\d{2}$/', $heure)) {
    header("Location: ../index.php?erreur=date");
    exit;
}

$dateHeure = new DateTime($date . ' ' . $heure);
if ($dateHeure < new DateTime()) {
    header("Location: ../index.php?erreur=date");
    exit;
}

$sql  = "SELECT COUNT(*) FROM reservations WHERE date = ? AND heure = ? AND nom_evenement = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$date, $heure, $nom_evenement]);
$existe = $stmt->fetchColumn();

if ($existe > 0) {
    header("Location: ../index.php?erreur=creneau");
    exit;
}

$sql  = "INSERT INTO reservations (nom, nom_evenement, date, heure) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nom, $nom_evenement, $date, $heure]);

header("Location: ../index.php?succes=1");
exit;
?>
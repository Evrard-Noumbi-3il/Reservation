<?php
require_once '../config/connexion.php';

$nom             = "admin";
$mot_passe_clair = "admin";
$check = $pdo->prepare("SELECT COUNT(*) FROM compte WHERE nom = ?");
$check->execute([$nom]);
if ($check->fetchColumn() > 0) {
    echo "Le compte admin existe déjà.";
    exit;
}

$hash = password_hash($mot_passe_clair, PASSWORD_DEFAULT);

$sql  = "INSERT INTO compte (nom, mot_passe) VALUES (?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nom, $hash]);

echo "Compte créé.";
?>
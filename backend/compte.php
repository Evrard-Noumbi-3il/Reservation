<?php
require 'connexion.php';

$nom = "admin";
$mot_passe_clair = "admin";
$hash = password_hash($mot_passe_clair, PASSWORD_DEFAULT);

$sql = "INSERT INTO compte (nom, mot_passe) VALUES (?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nom, $hash]);

echo "Compte créé.";
?>

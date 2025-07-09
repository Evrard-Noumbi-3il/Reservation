<?php
session_start();
require_once '../config/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $mot_passe = $_POST['mot_passe'];

    $sql = "SELECT * FROM compte WHERE nom = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom]);

    $utilisateur = $stmt->fetch();

    if ($utilisateur && password_verify($mot_passe, $utilisateur['mot_passe'])) {
        // Authentification réussie
        $_SESSION['utilisateur'] = $utilisateur['nom'];
        header("Location: ../admin/dashboard.php");
        exit;
    } else {
        echo "Identifiants invalides.";
    }
} else {
    header("Location: ../login.php");
}

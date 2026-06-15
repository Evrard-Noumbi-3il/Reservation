<?php
session_start();
require_once '../config/connexion.php';

define('MAX_TENTATIVES', 5);
define('DUREE_BLOCAGE', 300); 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../admin/login.php");
    exit;
}

$nom       = trim($_POST['nom'] ?? '');
$mot_passe = $_POST['mot_passe'] ?? '';

$ip = $_SERVER['REMOTE_ADDR'];

if (!isset($_SESSION['tentatives']))      $_SESSION['tentatives']   = 0;
if (!isset($_SESSION['premier_echec']))   $_SESSION['premier_echec'] = null;

if (
    $_SESSION['tentatives'] >= MAX_TENTATIVES &&
    $_SESSION['premier_echec'] !== null &&
    (time() - $_SESSION['premier_echec']) < DUREE_BLOCAGE
) {
    $restant = DUREE_BLOCAGE - (time() - $_SESSION['premier_echec']);
    $minutes = ceil($restant / 60);
    header("Location: ../admin/login.php?erreur=bloque&minutes=" . $minutes);
    exit;
}

if (
    $_SESSION['premier_echec'] !== null &&
    (time() - $_SESSION['premier_echec']) >= DUREE_BLOCAGE
) {
    $_SESSION['tentatives']   = 0;
    $_SESSION['premier_echec'] = null;
}

if (!$nom || !$mot_passe) {
    header("Location: ../admin/login.php?erreur=champs");
    exit;
}

$sql  = "SELECT * FROM compte WHERE nom = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nom]);
$utilisateur = $stmt->fetch();

if ($utilisateur && password_verify($mot_passe, $utilisateur['mot_passe'])) {
    $_SESSION['tentatives']    = 0;
    $_SESSION['premier_echec'] = null;

    session_regenerate_id(true);

    $_SESSION['utilisateur'] = $utilisateur['nom'];
    header("Location: ../admin/dashboard.php");
    exit;
} else {
    $_SESSION['tentatives']++;
    if ($_SESSION['premier_echec'] === null) {
        $_SESSION['premier_echec'] = time();
    }

    $restantes = MAX_TENTATIVES - $_SESSION['tentatives'];
    if ($restantes > 0) {
        header("Location: ../admin/login.php?erreur=identifiants&restantes=" . $restantes);
    } else {
        header("Location: ../admin/login.php?erreur=bloque&minutes=" . ceil(DUREE_BLOCAGE / 60));
    }
    exit;
}
?>
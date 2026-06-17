<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    http_response_code(403);
    echo "Accès refusé";
    exit;
}

require_once '../config/connexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Méthode non autorisée";
    exit;
}

if (
    empty($_POST['csrf_token']) ||
    !isset($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    http_response_code(403);
    echo "Token invalide";
    exit;
}

$id = $_POST['id'] ?? '';

if (!$id || !is_numeric($id)) {
    http_response_code(400);
    echo "ID invalide";
    exit;
}

$stmt = $pdo->prepare("DELETE FROM reservations WHERE id = ?");
if ($stmt->execute([intval($id)])) {
    echo "OK";
} else {
    http_response_code(500);
    echo "Erreur SQL";
}
?>
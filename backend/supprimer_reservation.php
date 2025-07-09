<?php
require_once 'connexion.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $pdo->prepare("DELETE FROM reservations WHERE id = ?");
    if ($stmt->execute([$id])) {
        echo "OK";
    } else {
        echo "Erreur SQL";
    }
} else {
    echo "ID invalide";
}

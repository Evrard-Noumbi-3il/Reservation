<?php
session_start();

// Supprimer toutes les données de session
$_SESSION = [];
session_unset();
session_destroy();

// Rediriger vers login
header("Location: login.php");
exit;
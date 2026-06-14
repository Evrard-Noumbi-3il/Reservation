<?php

// en fin de test : je détermine le chemin de base selon la profondeur du fichier appelant 
$depth = substr_count(str_replace('\\', '/', $_SERVER['SCRIPT_NAME']), '/') - 1;
$base  = str_repeat('../', max(0, $depth - 1));

$script = basename($_SERVER['SCRIPT_NAME']);
$rootFiles = ['index.php', 'about.php'];
if (in_array($script, $rootFiles)) {
    $base = '';
}
?>
<header>
    <h1>Module de Réservation</h1>
    <nav>
        <a href="<?= $base ?>index.php">Accueil</a> |
        <a href="<?= $base ?>admin/login.php">Admin</a> |
        <a href="<?= $base ?>about.php">À propos</a>
    </nav>
</header>
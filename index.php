<?php session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservation Salle</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <h3>Réserver une salle</h3>

    <?php if (isset($_GET['erreur'])): ?>
        <p class="erreur">
        <?php
        switch ($_GET['erreur']) {
            case 'creneau':  echo "Ce créneau est déjà réservé."; break;
            case 'champs':   echo "Tous les champs sont obligatoires."; break;
            case 'date':     echo "La date sélectionnée est invalide."; break;
            case 'csrf':     echo "Requête invalide. Veuillez réessayer."; break;
            default:         echo "Une erreur est survenue.";
        }
        ?>
        </p>
    <?php endif; ?>

    <?php if (isset($_GET['succes'])): ?>
        <p class="succes">Réservation effectuée avec succès !</p>
    <?php endif; ?>

    <form action="backend/reserver.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

        <label>Nom :</label>
        <input type="text" name="nom" required class="input-centre">

        <label>Nom de l'événement :</label>
        <input type="text" name="nom_evenement" required class="input-centre">

        <label>Date :</label>
        <input type="date" name="date" required class="input-centre">

        <label>Heure :</label>
        <input type="time" name="heure" required class="input-centre">

        <button type="submit">Réserver</button>
    </form>

    <?php include 'includes/footer.php'; ?>
    <script src="reservation.js"></script>
</body>
</html>
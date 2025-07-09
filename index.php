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
    <form action="backend/reserver.php" method="POST">
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
</body>
<script src="reservation.js"></script>
</html>

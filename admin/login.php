<?php
session_start();
if (isset($_SESSION['utilisateur'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="/Reservation/style.css">
</head>
<body>
<?php include '../includes/header.php'; ?>
    <div class="container">
        <h2>Connexion à l'espace admin</h2>
        <form action="../backend/verifier_connexion.php" method="POST">
            <input type="text" name="nom" placeholder="Nom d'utilisateur" required>
            <input type="password" name="mot_passe" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
            <a href='../index.php' style=" color: white; background-color: red; border-radius: 10px;  padding: 10px;"> Retour </a>
        </form>

    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>

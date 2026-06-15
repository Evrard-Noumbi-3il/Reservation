<?php
session_start();
if (isset($_SESSION['utilisateur'])) {
    header("Location: dashboard.php");
    exit;
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
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
        <?php
        if (isset($_GET['erreur'])) {
            switch ($_GET['erreur']) {
                case 'identifiants':
                    $restantes = intval($_GET['restantes'] ?? 0);
                    echo '<p class="erreur">Identifiants invalides. ' . $restantes . ' tentative(s) restante(s).</p>';
                    break;
                case 'bloque':
                    $minutes = intval($_GET['minutes'] ?? 5);
                    echo '<p class="erreur">Compte temporairement bloqué. Réessayez dans ' . $minutes . ' minute(s).</p>';
                    break;
                case 'csrf':
                    echo '<p class="erreur">Requête invalide. Veuillez réessayer.</p>';
                    break;
                case 'champs':
                    echo '<p class="erreur">Veuillez remplir tous les champs.</p>';
                    break;
            }
        }
        ?>
        <form action="../backend/verifier_connexion.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

            <input type="text"     name="nom"       placeholder="Nom d'utilisateur" required>
            <input type="password" name="mot_passe" placeholder="Mot de passe"      required>
            <button type="submit">Se connecter</button>
            <a href='../index.php' style="color:white;background-color:red;border-radius:10px;padding:10px;">Retour</a>
        </form>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
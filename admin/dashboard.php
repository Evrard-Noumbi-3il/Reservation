<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/Reservation/style.css">
</head>
<body>
<?php include '../includes/header.php'; ?>
    <div class="container">
        <h2>Bienvenue, <?= htmlspecialchars($_SESSION['utilisateur']) ?> !</h2>
        <p>Ceci est votre tableau de bord sécurisé.</p>

        <?php
            require_once '../config/connexion.php';
            $req = $pdo->query("SELECT * FROM reservations ORDER BY date ASC");
            $reservations = $req->fetchAll();
        ?>

            <div class="card-container">
                <?php foreach ($reservations as $res) : ?>
                    <div class="reservation-card">
                        <h2><?= htmlspecialchars($res['nom_evenement']) ?></h3>
                        <p><strong>Nom :</strong> <?= htmlspecialchars($res['nom']) ?></p>
                        <p><strong>Date :</strong> <?= $res['date'] ?></p>
                        <p><strong>Heure :</strong> <?= $res['heure'] ?></p>
                        <button class="delete-btn" data-id="<?= $res['id'] ?>">Supprimer</button>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <button onclick="window.location.href='../admin/logout.php'">Se déconnecter</button>

    </div>

    <script src="../reservation.js"></script>
    <?php include '../includes/footer.php'; ?>
</body>
</html>

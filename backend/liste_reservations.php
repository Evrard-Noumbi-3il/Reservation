<?php
require_once('../config/connexion.php');
$stmt = $pdo->query("SELECT id, nom, nom_evenement, date, heure FROM reservations ORDER BY date ASC, heure ASC");
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<ul>
<?php foreach ($reservations as $r): ?>
    <li>
        <?= htmlspecialchars($r['date']) ?> à <?= htmlspecialchars($r['heure']) ?> —
        <?= htmlspecialchars($r['nom']) ?>
        (événement : <strong><?= htmlspecialchars($r['nom_evenement']) ?></strong>)
    </li>
<?php endforeach; ?>
</ul>
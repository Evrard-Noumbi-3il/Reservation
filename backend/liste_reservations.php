<?php
require_once('../config/db.php');
$stmt = $pdo->query("SELECT * FROM reservations ORDER BY date, heure");
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

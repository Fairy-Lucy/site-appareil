<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Appareils en <?= htmlspecialchars($pays) ?></title>
    <link rel="stylesheet" href="/public/css/index/styleIndex.css">
</head>
<body>

<?php require "App/View/navbar/navbarView.php"; ?>

<h1>Appareils photo fabriqués en <?= htmlspecialchars($pays) ?></h1>

<?php if (!empty($appareils)): ?>
    <ul>
        <?php foreach ($appareils as $appareil): ?>
            <li>
                <strong><?= htmlspecialchars($appareil['nom_appareil']) ?></strong>
                (<?= $appareil['annee_debut'] ?> - <?= $appareil['annee_fin'] ?>)
                - <?= htmlspecialchars($appareil['remarques']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun appareil trouvé pour ce pays.</p>
<?php endif; ?>

</body>
</html>

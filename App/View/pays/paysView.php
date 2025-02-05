<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Appareils en <?= htmlspecialchars($pays) ?></title>
    <link rel="stylesheet" href="/public/css/pays/stylePays.css">
</head>
<body>

<?php require "App/View/navbar/navbarView.php"; ?>

<h1>Appareils photo fabriqués en <?= htmlspecialchars($pays) ?></h1>

<?php if (!empty($appareils)): ?>
    <div class="appareil-container">
        <?php foreach ($appareils as $appareil): ?>
            <a href="/router.php?route=appareil_details&id=<?= htmlspecialchars($appareil['id']) ?>" class="appareil-card-link">
                <div class="appareil-card">
                    <img src="/public/images/<?= htmlspecialchars($appareil['image'] ?? 'default.jpg') ?>" alt="<?= htmlspecialchars($appareil['fabriquant']) ?> <?= htmlspecialchars($appareil['nom_appareil']) ?>">
                    <h3><?= htmlspecialchars($appareil['fabricant']) ?> <?= htmlspecialchars($appareil['nom_appareil']) ?></h3>
                    <p>(<?= $appareil['annee_debut'] ?> - <?= $appareil['annee_fin'] ?>)</p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucun appareil trouvé pour ce pays.</p>
<?php endif; ?>

</body>
</html>

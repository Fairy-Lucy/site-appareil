<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Appareils par fabricants</title>
    <link rel="stylesheet" href="/public/css/fabricant/styleFabricants.css">
</head>
<body>

<?php require "App/View/navbar/navbarView.php"; ?>

<h1>Appareils photo par fabricant</h1>

<!-- Navigation alphabétique -->
<div class="alphabet-nav">
    <?php foreach (range('A', 'Z') as $letter): ?>
        <a href="?route=appareils_fabricants&letter=<?= $letter ?>"><?= $letter ?></a>
    <?php endforeach; ?>
</div>

<?php
$letterFilter = $_GET['letter'] ?? null;

// Trier les appareils par fabricant
usort($appareils, function ($a, $b) {
    return strcmp($a['fabricant'], $b['fabricant']);
});

$currentFabricant = null;
?>

<?php if (!empty($appareils)): ?>
    <div class="appareil-container">
        <?php foreach ($appareils as $appareil): ?>
            <?php
            if ($letterFilter && strtoupper($appareil['fabricant'][0]) !== $letterFilter) {
                continue;
            }

            if ($appareil['fabricant'] !== $currentFabricant):
                $currentFabricant = $appareil['fabricant'];
                ?>
                <!-- Barre de séparation pour chaque marque -->
                <div class="fabriquant-bar">
                    <span><?= htmlspecialchars($currentFabricant) ?></span>
                </div>
            <?php endif; ?>

            <a href="/router.php?route=appareil_details&id=<?= htmlspecialchars($appareil['id']) ?>" class="appareil-card-link">
                <div class="appareil-card">
                    <img src="/public/images/<?= htmlspecialchars($appareil['image'] ?? 'default.jpg') ?>" alt="<?= htmlspecialchars($appareil['fabricant']) ?> <?= htmlspecialchars($appareil['nom_appareil']) ?>">
                    <h3><?= htmlspecialchars($appareil['nom_appareil']) ?></h3>
                    <p>(<?= $appareil['annee_debut'] ?> - <?= $appareil['annee_fin'] ?>)</p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucun appareil trouvé.</p>
<?php endif; ?>

</body>
</html>

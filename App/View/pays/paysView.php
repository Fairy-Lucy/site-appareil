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

<?php
// Trier les appareils du plus ancien au plus récent
usort($appareils, function ($a, $b) {
    return $a['annee_debut'] <=> $b['annee_debut'];
});

$currentDecade = null;
?>

<?php if (!empty($appareils)): ?>
    <div class="appareils-container">
    <?php foreach ($appareils as $appareil): ?>
        <?php
        $decade = floor($appareil['annee_debut'] / 10) * 10;
        if ($decade !== $currentDecade):
            if ($currentDecade !== null): ?>
                </div> <!-- Ferme le dernier groupe decade-group -->
            <?php endif; ?>

            <div class="decade-bar">
                <span><?= $decade ?>s</span>
            </div>

            <div class="decade-group">
            <?php $currentDecade = $decade;
        endif;
        ?>

        <a href="/router.php?route=appareil_details&id=<?= htmlspecialchars($appareil['id']) ?>" class="appareil-card-link">
            <div class="appareil-card">
                <img src="/public/images/<?= htmlspecialchars($appareil['image'] ?? 'default.jpg') ?>"
                     alt="<?= htmlspecialchars($appareil['fabricant']) ?> <?= htmlspecialchars($appareil['nom_appareil']) ?>">
                <h3><?= htmlspecialchars($appareil['fabricant']) ?> <?= htmlspecialchars($appareil['nom_appareil']) ?></h3>
                <p>(<?= $appareil['annee_debut'] ?> - <?= $appareil['annee_fin'] ?>)</p>
            </div>
        </a>

    <?php endforeach; ?>
    </div> <!-- Ferme le dernier .decade-group -->
    </div> <!-- Ferme .appareils-container -->
<?php else: ?>
    <p>Aucun appareil trouvé pour ce pays.</p>
<?php endif; ?>

</body>
</html>

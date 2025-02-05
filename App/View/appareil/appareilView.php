<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($appareil['fabricant']) ?><?= htmlspecialchars($appareil['nom_appareil']) ?></title>
    <link rel="stylesheet" href="/public/css/appareil/styleAppareil.css">
</head>
<body>

<?php require "App/View/navbar/navbarView.php"; ?>

<h1>Détails de l'appareil : <?= htmlspecialchars($appareil['fabricant']) ?> <?= htmlspecialchars($appareil['nom_appareil']) ?></h1>

<div class="appareil-details">
    <div class="image-gallery">
        <?php foreach ($images as $image): ?>
            <img src="public/images/<?= htmlspecialchars($image) ?>" alt="Image de <?= htmlspecialchars($appareil['nom_appareil']) ?>">
        <?php endforeach; ?>
    </div>
    <p><strong>Nom :</strong> <?= htmlspecialchars($appareil['nom_appareil']) ?></p>
    <p><strong>Fabrication :</strong> <?= $appareil['annee_debut'] ?> - <?= $appareil['annee_fin'] ?></p>
    <p><strong>Pays :</strong> <?= htmlspecialchars($appareil['pays']) ?></p>
    <p><strong>Commentaire :</strong> <?= htmlspecialchars($appareil['remarques']) ?></p>
    <p><strong>Description :</strong> <?= htmlspecialchars($description) ?></p>
</div>

</body>
</html>

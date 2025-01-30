<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de l'appareil <?= htmlspecialchars($appareil['nom_appareil']) ?></title>
    <link rel="stylesheet" href="/public/css/appareil/styleAppareil.css">
</head>
<body>

<?php require "App/View/navbar/navbarView.php"; ?>

<h1>Détails de l'appareil : <?= htmlspecialchars($appareil['nom_appareil']) ?></h1>

<div class="appareil-details">
    <img src="/public/images/appareils/<?= htmlspecialchars($appareil['image']) ?>" alt="<?= htmlspecialchars($appareil['nom_appareil']) ?>">
    <p><strong>Nom :</strong> <?= htmlspecialchars($appareil['nom_appareil']) ?></p>
    <p><strong>Fabrication :</strong> <?= $appareil['annee_debut'] ?> - <?= $appareil['annee_fin'] ?></p>
    <p><strong>Pays :</strong> <?= htmlspecialchars($appareil['pays']) ?></p>
    <p><strong>Commentaire :</strong> <?= htmlspecialchars($appareil['remarques']) ?></p>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($appareil['nom_appareil']) ?></title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>

<?php require __DIR__ . "/../navbar/navbarView.php"; ?>

<h1><?= htmlspecialchars($appareil['nom_appareil']) ?></h1>
<p>Pays : <?= htmlspecialchars($appareil['pays']) ?></p>
<p>Années de fabrication : <?= $appareil['annee_debut'] ?> - <?= $appareil['annee_fin'] ?></p>
<p>Remarques : <?= htmlspecialchars($appareil['remarques']) ?></p>

</body>
</html>

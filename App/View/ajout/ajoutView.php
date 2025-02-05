<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Appareil Photo</title>
    <link rel="stylesheet" href="../../../public/css/ajout/ajout.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<?php require __DIR__ . "/../navbar/navbarView.php"; ?>

<h1>Ajouter un Nouvel Appareil Photo</h1>

<form id="ajoutForm" method="post" action="router.php?route=ajouter_appareil&step=4">
    <!-- Étape 1 : Sélection du fabricant -->
    <?php if ($_GET['step'] == 1 || !isset($_GET['step'])): ?>
        <label>Fabricant :</label>
        <select name="fabricant" id="fabricant">
            <?php foreach ($fabricants as $fab): ?>
                <option value="<?= htmlspecialchars($fab['fabricant']) ?>"><?= htmlspecialchars($fab['fabricant']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="button" onclick="goToStep2()">Suivant</button>
    <?php endif; ?>

    <!-- Étape 2 : Sélection du modèle -->
    <?php if ($_GET['step'] == 2): ?>
        <h2>Modèles de <?= htmlspecialchars($_GET['fabricant']) ?></h2>
        <select name="modele" id="modele">
            <?php foreach ($modeles as $mod): ?>
                <option value="<?= htmlspecialchars($mod['nom']) ?>"><?= htmlspecialchars($mod['nom']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="button" onclick="goToStep3()">Suivant</button>
    <?php endif; ?>

    <!-- Étape 3 : Détails -->
    <?php if ($_GET['step'] == 3): ?>
        <h2>Détails du modèle <?= htmlspecialchars($_GET['modele']) ?></h2>
        <label>Pays :</label>
        <input type="text" name="pays" value="<?= htmlspecialchars($detailsModele['pays'] ?? '') ?>" required>

        <label>Année de début :</label>
        <input type="number" name="debut" value="<?= htmlspecialchars($detailsModele['annee_debut'] ?? '') ?>" required>

        <label>Année de fin :</label>
        <input type="number" name="fin" value="<?= htmlspecialchars($detailsModele['annee_fin'] ?? '') ?>" required>

        <label>Commentaire :</label>
        <textarea name="commentaire"></textarea> <!-- Pas de préremplissage ici -->

        <label>Description :</label>
        <textarea name="description"><?= htmlspecialchars($detailsModele['description'] ?? '') ?></textarea>

        <button type="submit">Ajouter l'appareil</button>
    <?php endif; ?>

</form>

<script>
    function goToStep2() {
        const fabricant = document.getElementById('fabricant').value;
        if (fabricant) {
            window.location.href = `router.php?route=ajouter_appareil&step=2&fabricant=${fabricant}`;
        }
    }

    function goToStep3() {
        const modele = document.getElementById('modele').value;
        const fabricant = new URLSearchParams(window.location.search).get('fabricant');
        if (modele) {
            window.location.href = `router.php?route=ajouter_appareil&step=3&fabricant=${fabricant}&modele=${modele}`;
        }
    }
</script>
</body>
</html>
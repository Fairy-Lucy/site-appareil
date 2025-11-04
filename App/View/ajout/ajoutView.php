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

<?php
$step = isset($_GET['step']) ? (int) $_GET['step'] : 1;
$fabricant = isset($_GET['fabricant']) ? htmlspecialchars($_GET['fabricant'], ENT_QUOTES, 'UTF-8') : '';
$modele = isset($_GET['modele']) ? htmlspecialchars($_GET['modele'], ENT_QUOTES, 'UTF-8') : '';
?>

<form id="ajoutForm" method="post"
      action="router.php?route=ajouter_appareil&amp;step=<?= htmlspecialchars($step, ENT_QUOTES, 'UTF-8') ?>">

    <!-- Étape 1 : Sélection ou ajout d'un fabricant -->
    <?php if ($step === 1): ?>
        <label for="fabricant">Fabricant :</label>
        <select name="fabricant" id="fabricant">
            <?php foreach ($fabricants as $fab): ?>
                <option value="<?= htmlspecialchars($fab['fabricant'], ENT_QUOTES, 'UTF-8') ?>">
                    <?= htmlspecialchars($fab['fabricant'], ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="nouveau_fabricant">Nouveau fabricant :</label>
        <input type="text" name="nouveau_fabricant" id="nouveau_fabricant">
        <button type="button" onclick="goToStep2()">Suivant</button>
    <?php endif; ?>

    <!-- Étape 2 : Sélection ou ajout d'un modèle -->
    <?php if ($step === 2): ?>
        <h2>Modèles de <?= $fabricant ?></h2>
        <select name="modele" id="modele">
            <?php foreach ($modeles as $mod): ?>
                <option value="<?= htmlspecialchars($mod['nom'], ENT_QUOTES, 'UTF-8') ?>">
                    <?= htmlspecialchars($mod['nom'], ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="nouveau_modele">Nouveau modèle :</label>
        <input type="text" name="nouveau_modele" id="nouveau_modele">
        <button type="button" onclick="goToStep3()">Suivant</button>
    <?php endif; ?>

    <!-- Étape 3 : Détails -->
    <?php if ($step === 3): ?>
        <h2>Détails du modèle <?= $modele ?></h2>

        <label for="pays">Pays :</label>
        <input type="text" name="pays" id="pays"
               value="<?= htmlspecialchars($PaysModele ?? '', ENT_QUOTES, 'UTF-8') ?>" required>

        <label for="debut">Année de début :</label>
        <input type="number" name="debut" id="debut"
               value="<?= htmlspecialchars($Annee_DebutModele ?? '', ENT_QUOTES, 'UTF-8') ?>" required>

        <label for="fin">Année de fin :</label>
        <input type="number" name="fin" id="fin"
               value="<?= htmlspecialchars($Annee_FinModele ?? '', ENT_QUOTES, 'UTF-8') ?>" required>

        <label for="commentaire">Commentaire :</label>
        <textarea name="commentaire" id="commentaire"></textarea>

        <label for="description">Description :</label>
        <textarea name="description" id="description">
            <?= htmlspecialchars($DescriptionModele ?? '', ENT_QUOTES, 'UTF-8') ?>
        </textarea>

        <button type="submit">Ajouter l'appareil</button>
    <?php endif; ?>

</form>

<script>
    function goToStep2() {
        let fabricant = document.getElementById('fabricant').value;
        let nouveauFabricant = document.getElementById('nouveau_fabricant').value.trim();

        if (nouveauFabricant !== '') {
            fabricant = nouveauFabricant;
        }

        if (fabricant) {
            window.location.href = `router.php?route=ajouter_appareil&step=2&fabricant=${encodeURIComponent(fabricant)}`;
        }
    }

    function goToStep3() {
        let modele = document.getElementById('modele').value;
        let nouveauModele = document.getElementById('nouveau_modele').value.trim();
        let fabricant = new URLSearchParams(window.location.search).get('fabricant');

        if (nouveauModele !== '') {
            modele = nouveauModele;
        }

        if (modele) {
            window.location.href = `router.php?route=ajouter_appareil&step=3&fabricant=${encodeURIComponent(fabricant)}&modele=${encodeURIComponent(modele)}`;
        }
    }
</script>

</body>
</html>

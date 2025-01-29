<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Appareil Photo</title>
    <link rel="stylesheet" href="/public/css/ajout/ajout.css">
</head>
<body>

<?php require __DIR__ . "/../navbar/navbarView.php"; ?>

<h1>Ajouter un Nouvel Appareil Photo</h1>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p style="color: green;">✅ Appareil ajouté avec succès !</p>
<?php endif; ?>

<form action="../../Controller/ajout/ajoutController.php" method="post">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>

    <label for="pays">Pays :</label>
    <input type="text" id="pays" name="pays" required>

    <label for="debut">Année de début :</label>
    <input type="number" id="debut" name="debut" required>

    <label for="fin">Année de fin :</label>
    <input type="number" id="fin" name="fin" required>

    <label for="commentaire">Commentaire :</label>
    <textarea id="commentaire" name="commentaire"></textarea>

    <button type="submit">Ajouter</button>
</form>

</body>
</html>

<?php
$message = $_GET['msg'] ?? 'Une erreur s\'est produite';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Erreur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
            padding-top: 50px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Erreur</h1>
    <p><?= htmlentities($message) ?></p>
    <a href="../index/indexView.php">Retour à l'accueil</a>
</div>
</body>
</html>
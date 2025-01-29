<?php
require_once __DIR__ . "/../../../app/Controller/AppareilController.php";
if (!isset($countries)) {
    $countries = []; // Assure que la variable existe pour éviter des erreurs
}
?>

<nav>
    <ul>
        <li><a href="../index/indexView.php">Accueil</a></li>
        <?php foreach ($countries as $country): ?>
            <li><a href="/router.php?route=appareils_pays&pays=<?= urlencode($country['pays']) ?>">
                    <?= htmlspecialchars($country['pays']) ?>
                </a></li>
        <?php endforeach; ?>
    </ul>
</nav>

<?php
require_once "../../Controller/AppareilController.php";
$controller = new AppareilController();
$countries = $controller->getCountries();
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

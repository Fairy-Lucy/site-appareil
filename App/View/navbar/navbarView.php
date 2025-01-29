<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "utilisateur", "motdepasse", "nom_de_la_bdd");
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupération des pays uniques
$sql = "SELECT DISTINCT pays FROM appareils_photo ORDER BY pays";
$result = $conn->query($sql);
?>

<nav>
    <link rel="stylesheet" href="../../../public/css/navbar/styleNavbar.css">
    <ul>
        <li><a href="../index/indexView.php">Accueil</a></li>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li><a href="pays.php?pays=<?= urlencode($row['pays']) ?>"><?= htmlspecialchars($row['pays']) ?></a></li>
        <?php endwhile; ?>
    </ul>
</nav>

<?php $conn->close(); ?>

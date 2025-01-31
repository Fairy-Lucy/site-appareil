<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Collection d'Appareils Photo</title>
    <link rel="stylesheet" href="../../../public/css/index/styleIndex.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!-- Navbar -->
<?php require "App/View/navbar/navbarView.php"; ?>

<!-- Section Accueil -->
<section class="intro">
    <h1>Pouet pouet ce sont mes appareils photo</h1>
    <p>je tente de trouver un truc pour les afficher</p>
</section>

<!-- Galerie de Photos -->
<section class="gallery">
    <h2>Quelques Photo</h2>
    <div class="photo-gallery">
        <a href="../../../public/images/yashica-mat-124.jpg" data-lightbox="gallery" data-title="Appareil Photo 1">
            <img src="../../../public/images/yashica-mat-124.jpg" alt="yashica mat 124">
        </a>
        <a href="../../../public/images/collection_complete.jpg" data-lightbox="gallery" data-title="la collection">
            <img src="../../../public/images/collection_complete.jpg" alt="la collection">
        </a>
        <a href="../../../public/images/zenit-ttl-objet.jpg" data-lightbox="gallery" data-title="zenit ttl">
            <img src="../../../public/images/zenit-ttl-objet.jpg" alt="zenit ttl">
        </a>
        <!-- Ajouter d'autres images -->
    </div>
</section>

<!-- Statistiques -->
<section class="stats">
    <h2>Quelques Stats</h2>
    <table>
        <tr>
            <th>Total Appareils</th>
            <td><?= $totalAppareils ?></td>
        </tr>
        <tr>
            <th>Année la plus ancienne</th>
            <td><?= $anneePlusAncienne ?></td>
        </tr>
        <tr>
            <th>Année la plus récente</th>
            <td><?= $anneePlusRecente ?></td>
        </tr>
        <tr>
            <th>Appareils par Pays</th>
            <td>
                <ul>
                    <?php foreach ($appareilsParPays as $pays => $count): ?>
                        <li><?= htmlspecialchars($pays) ?>: <?= $count ?></li>
                    <?php endforeach; ?>
                </ul>
            </td>
        </tr>
    </table>
</section>

<!-- Diagramme des Appareils par Année -->
<section class="chart">
    <h2>Répartition des Appareils par Année</h2>
    <canvas id="appareilsParAnneeChart"></canvas>
    <script>
        const ctx = document.getElementById('appareilsParAnneeChart').getContext('2d');
        const appareilsParAnneeData = <?php echo json_encode($appareilsParAnnee); ?>;

        const chartLabels = appareilsParAnneeData.map(item => item.annee_debut);
        const chartData = appareilsParAnneeData.map(item => item.count);

        const appareilsParAnneeChart = new Chart(ctx, {
            type: 'bar', // Type de graphique : barres
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Nombre d\'appareils',
                    data: chartData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</section>

<!-- Section A propos -->
<section class="about">
    <h2>À Propos de Ma Collection</h2>
    <p>J'ai commencé ma collection il y a X années, et je me passionne pour... [ajoute une description sur ta passion et les types d'appareils que tu préfères]</p>
</section>

<!-- Call to Action (Voir plus / Contact) -->
<section class="cta">
    <button onclick="window.location.href='pageCollection.php';">Voir toute la collection</button>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Ma Collection d'Appareils Photo</p>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

</body>
</html>

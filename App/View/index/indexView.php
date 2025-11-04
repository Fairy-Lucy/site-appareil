<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Collection d'Appareils Photo</title>
    <link rel="stylesheet" href="../../../public/css/index/styleIndex.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>

<!-- Navbar -->
<?php require_once "App/View/navbar/navbarView.php"; ?>

<!-- Section Accueil -->
<section class="intro">
    <h1>Pouet pouet c'est sont mes appareils photo</h1>
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

<section class="map-container">
    <h2>Appareils par Pays</h2>
    <div id="map" style="height: 500px;"></div>
</section>

<section class="timeline">
    <h2>Historique d’Achat</h2>
    <canvas id="timelineChart"></canvas>
</section>

<script>
    const ctx = document.getElementById('timelineChart').getContext('2d');
    const timelineData = <?php echo json_encode($timelineData); ?>;

    const chartLabels = timelineData.map(item => item.annee);
    const chartData = timelineData.map(item => item.count);

    const timelineChart = new Chart(ctx, {
        type: 'line', // Type de graphique : ligne
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Nombre d\'appareils par année',
                data: chartData,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


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
                responsive: true,
                maintainAspectRatio: false,
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
<script>
    var map = L.map('map').setView([20, 0], 2); // Vue initiale centrée sur le monde

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var appareilsParPays = <?= json_encode($appareilsParPays) ?>;

    // Ajouter les marqueurs pour chaque pays
    for (var pays in appareilsParPays) {
        L.marker(getCoordinates(pays)).addTo(map)
            .bindPopup(`<b>${pays}</b><br>${appareilsParPays[pays]} appareils`)
            .on('click', function() {
                // Récupération du texte brut du pays sans les balises HTML
                let paysNom = this.getPopup().getContent().split('<br>')[0].replace(/<\/?b>/g, '');
                window.location.href = `router.php?route=appareils_pays&pays=${encodeURIComponent(paysNom)}`;
            });
    }

    function getCoordinates(pays) {
        var coords = {
            "Allemagne": [52.51859005314091, 13.37617519118166],
            "Autriche":[48.204507619281, 16.36079244792706],
            "Chine": [39.91195686171867, 116.39092691256604],
            "France": [48.85822280995211, 2.294544153892626],
            "Grande-bretagne": [51.50067848616132, 0.12455901567686167],
            "Hong-Kong":[22.279255190697224,114.16156633276101],
            "Italie":[41.890188338706494,12.492341623723654],
            "Japon": [35.682427911284364, 139.7527462868448],
            "Liechtenstein" : [47.13934600822916,9.52458380229659],
            "Macao":[22.190951209997383, 113.54340261622636],
            "Pays-Bas":[52.3731110239013,4.8913038111120555],
            "Tchecoslovaquie":[50.09088931153374,14.400527482033825],
            "URSS": [55.75372759279802, 37.6199055708892],
            "USA": [40.711042594071046, -74.01309064703592]
        };
        return coords[pays] || [0, 0];
    }
</script>

</body>
</html>

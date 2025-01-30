<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Collection d'Appareils Photo</title>
    <link rel="stylesheet" href="../../../public/css/index/styleIndex.css">
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
    <h2>Galerie de Ma Collection</h2>
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

<?php
class CollectionController {
    public function afficherCollection() {
        $pays = $_GET['country'] ?? 'Tous';
        require "App/View/collection/collectionView.php";
    }
}

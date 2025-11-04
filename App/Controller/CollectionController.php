<?php
class CollectionController {
    public function afficherCollection() {
        $pays = $_GET['country'] ?? 'Tous';
        require_once "App/View/collection/collectionView.php";
    }
}

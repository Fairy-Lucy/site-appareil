<?php
class CollectionController {
    public function afficherCollection() {
        $pays = $_GET['country'] ?? 'Tous';
        require "../View/collection/collectionView.php";
    }
}

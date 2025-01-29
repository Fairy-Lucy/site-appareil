<?php
require_once "app/Model/AppareilModel.php";

class AppareilController {
    private $model;

    public function __construct() {
        $this->model = new AppareilModel();
    }

    // Affiche les appareils d'un pays
    public function appareilsParPays($pays) {
        $appareils = $this->model->getAppareilsByCountry($pays);
        require "app/View/appareil/paysView.php";  // Passe les données à la vue
    }

    // Récupère la liste des pays
    public function getCountries() {
        return $this->model->getAllCountries();
    }
}

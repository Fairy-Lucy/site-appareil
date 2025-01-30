<?php
class IndexController {
    private $model;

    public function __construct() {
        $this->model = new AppareilModel();
    }

    public function afficherAccueil() {
        // Récupérer les statistiques
        $totalAppareils = $this->model->getTotalAppareils();
        $appareilsParPays = $this->model->getAppareilsParPays();
        $anneePlusAncienne = $this->model->getAnneePlusAncienne();
        $anneePlusRecente = $this->model->getAnneePlusRecente();

        require "App/View/index/indexView.php";
    }
}

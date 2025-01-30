<?php
class IndexController {
    private $model;

    public function __construct() {
        $this->model = new AppareilModel();
    }

    public function afficherAccueil() {
        $totalAppareils = $this->model->getTotalAppareils();
        $appareilsParPays = $this->model->getAppareilsParPays();
        $anneePlusAncienne = $this->model->getAnneePlusAncienne();
        $anneePlusRecente = $this->model->getAnneePlusRecente();

        $appareilsParAnnee = $this->model->getAppareilsParAnnee();

        require "App/View/index/indexView.php";
    }

}

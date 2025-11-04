<?php
class IndexController {
    private $model;

    public function __construct() {
        $this->model = new AppareilModel();
    }

    public function afficherAccueil() {
        $totalAppareils = $this->model->getTotalAppareils();
        $anneePlusAncienne = $this->model->getAnneePlusAncienne();
        $anneePlusRecente = $this->model->getAnneePlusRecente();
        $timelineData = $this->model->getTimelineData();
        $appareilsParAnnee = $this->model->getAppareilsParAnnee();

        require "App/View/index/indexView.php";
    }

}

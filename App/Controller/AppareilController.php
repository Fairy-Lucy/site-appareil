<?php
require_once "App/Model/AppareilModel.php";

class AppareilController {
    private $model;

    public function __construct() {
        $this->model = new AppareilModel();
    }

    public function appareilsParPays($pays) {
        $appareils = $this->model->getAppareilsByCountry($pays);
        require "App/View/pays/paysView.php";
    }

    public function appareilDetails($id) {
        $appareil = $this->model->getAppareilById($id);
        if ($appareil) {
            $images = $this->model->getImagesByAppareilId($id);
            $description = $this->model->getDescriptionById($appareil['description_id']);
            require "App/View/appareil/appareilView.php";
        } else {
            echo "Appareil non trouvé.";
        }
    }
    public function appareilsParFabricant() {
        $model = new AppareilModel();
        $appareils = $model->getAppareilsParFabricant();
        require "App/View/fabricant/fabricantView.php";
    }
}

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
}

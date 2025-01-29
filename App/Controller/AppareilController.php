<?php
require_once "../Model/AppareilModel.php";

class AppareilController {
    private $model;

    public function __construct() {
        $this->model = new AppareilModel();
    }

    public function appareilsParPays($pays) {
        $appareils = $this->model->getAppareilsByCountry($pays);
        require __DIR__ . "../View/pays/paysView.php";
    }
}

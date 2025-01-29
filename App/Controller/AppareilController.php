<?php
require_once __DIR__ . "/../Model/AppareilModel.php";

class AppareilController {
    public function afficherAppareil($id) {
        $model = new AppareilModel();
        $appareil = $model->getAppareilById($id);

        if (!$appareil) {
            die("Appareil introuvable !");
        }

        require __DIR__ . "/../View/appareil/appareilView.php";
    }
}
?>

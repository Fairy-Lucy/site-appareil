<?php
require_once __DIR__ . "/../../Model/Database.php";
require_once __DIR__ . "/../../Model/AppareilModel.php";

class AjoutController {
    public function ajouterAppareil() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fabriquant = trim($_POST['fabriquant']);
            $nom = trim($_POST['nom']);
            $pays = trim($_POST['pays']);
            $debut = intval($_POST['debut']);
            $fin = intval($_POST['fin']);
            $commentaire = trim($_POST['commentaire']);
            $description = trim($_POST['description']);

            if (!empty($nom) && !empty($pays) && $debut > 0 && $fin > 0) {
                $appareilModel = new AppareilModel();
                $ajoutReussi = $appareilModel->ajouterAppareil($fabriquant, $nom, $pays, $debut, $fin, $commentaire, $description);

                if ($ajoutReussi) {
                    header("Location: ../../index.php?page=collection&success=1");
                    exit();
                } else {
                    echo "Erreur lors de l'ajout.";
                }
            } else {
                echo "Veuillez remplir tous les champs obligatoires.";
            }
        }
        include "App/View/ajout/ajoutView.php";
    }
}
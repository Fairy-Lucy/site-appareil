<?php
require_once "App/Model/Database.php";
require_once "App/Model/AjoutModel.php";

class AjoutController {
    private $ajoutModel;

    public function __construct() {
        $this->ajoutModel = new AjoutModel();
    }

    public function ajouterAppareil($step) {
        switch ($step) {
            case 1:
                $fabricants = $this->ajoutModel->getFabricants();
                include "App/View/ajout/ajoutView.php";
                break;

            case 2:
                $fabricant = $_GET['fabricant'] ?? '';
                $modeles = $this->ajoutModel->getModelesParFabricant($fabricant);
                include "App/View/ajout/ajoutView.php";
                break;

            case 3:
                $fabricant = $_GET['fabricant'] ?? $_POST['fabricant'] ?? '';
                $modele = $_GET['modele'] ?? $_POST['modele'] ?? $_POST['nouveau_modele'] ?? '';

                // Récupérer les détails si le modèle existe
                $detailsModele = $this->ajoutModel->getDetailsModele($fabricant, $modele);
                $PaysModele = $detailsModele['pays'] ?? '';
                $Annee_DebutModele = $detailsModele['annee_debut'] ?? '';
                $Annee_FinModele = $detailsModele['annee_fin'] ?? '';
                $DescriptionModele = $detailsModele['description'] ?? '';

                include "App/View/ajout/ajoutView.php";
                break;

            case 4:
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $fabricant = $_POST['fabricant'] ?? '';
                    $modele = $_POST['modele'] ?? '';
                    $pays = $_POST['pays'];
                    $debut = $_POST['debut'];
                    $fin = $_POST['fin'];
                    $commentaire = $_POST['commentaire'];
                    $description = $_POST['description'];

                    $success = $this->ajoutModel->ajouterAppareil($fabricant, $modele, $pays, $debut, $fin, $commentaire, $description);
                    if ($success) {
                        header("Location: router.php?route=collection&success=1");
                        exit();
                    } else {
                        echo "Erreur lors de l'ajout.";
                    }
                }
                break;

            default:
                header("Location: router.php?route=ajouter_appareil&step=1");
                break;
        }
    }
}

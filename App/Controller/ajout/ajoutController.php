<?php
require_once __DIR__ . "/../../Model/Database.php";
require_once __DIR__ . "/../../Model/AppareilModel.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST['nom']);
    $pays = trim($_POST['pays']);
    $debut = intval($_POST['debut']);
    $fin = intval($_POST['fin']);
    $commentaire = trim($_POST['commentaire']);

    if (!empty($nom) && !empty($pays) && $debut > 0 && $fin > 0) {
        $appareilModel = new AppareilModel();
        $ajoutReussi = $appareilModel->ajouterAppareil($nom, $pays, $debut, $fin, $commentaire);

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
?>

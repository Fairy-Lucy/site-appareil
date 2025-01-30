<?php

require_once "App/Model/AppareilModel.php";
require_once "App/Controller/AppareilController.php";
require_once "App/Controller/IndexController.php";

$route = $_GET['route'] ?? 'index';

switch ($route) {
    case 'appareils_pays':
        $pays = $_GET['pays'] ?? null;
        if ($pays === null) {
            header("Location: /error.php?msg=Aucun+pays+sélectionné.");
            exit();
        }
        $controller = new AppareilController();
        $controller->appareilsParPays($pays);
        break;

    case 'appareil_details':
        $id = $_GET['id'] ?? null;
        if ($id === null) {
            header("Location: /error.php?msg=Aucun+appareil+sélectionné.");
            exit();
        }
        $controller = new AppareilController();
        $controller->appareilDetails($id);
        break;

    case 'index':
    default:
        $controller = new IndexController();
        $controller->afficherAccueil();
        break;
}

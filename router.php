<?php
require_once "App/Model/AppareilModel.php";
require_once "App/Controller/AppareilController.php";
require_once "App/Controller/IndexController.php";
require_once "App/Controller/ajout/AjoutController.php";

$route = $_GET['route'] ?? 'index';

switch ($route) {
    case 'appareils_pays':
        $pays = $_GET['pays'] ?? null;
        (new AppareilController())->appareilsParPays($pays);
        break;

    case 'appareil_details':
        $id = $_GET['id'] ?? null;
        (new AppareilController())->appareilDetails($id);
        break;

    case 'ajouter_appareil':
        $controller = new AjoutController();
        $step = $_GET['step'] ?? 1;
        $controller->ajouterAppareil($step);
        break;

    case 'index':
    default:
        (new IndexController())->afficherAccueil();
        break;
}

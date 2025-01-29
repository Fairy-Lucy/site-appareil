<?php
require_once "app/Controller/AppareilController.php";
require_once "app/Controller/CollectionController.php";
require_once "app/Controller/IndexController.php";

$controller = new AppareilController();
$countries = $controller->getCountries();
require_once "app/View/navbar/navbarView.php";


$controller = null;
$route = $_GET['route'] ?? 'index';

switch ($route) {
    case 'appareils_pays':
        if (!isset($_GET['pays'])) die("Aucun pays sélectionné.");
        $controller = new AppareilController();
        $controller->appareilsParPays($_GET['pays']);
        break;

    case 'collection':
        $controller = new CollectionController();
        $controller->afficherCollection();
        break;

    case 'index':
    default:
        $controller = new IndexController();
        $controller->afficherAccueil();
        break;
}

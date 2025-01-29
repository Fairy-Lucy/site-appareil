<?php
require_once "app/Controller/AppareilController.php";
require_once "app/Controller/IndexController.php";

$route = $_GET['route'] ?? 'index';

switch ($route) {
case 'appareils_pays':
if (!isset($_GET['pays'])) {
die("Aucun pays sélectionné.");
}
$controller = new AppareilController();
$controller->appareilsParPays($_GET['pays']);
break;

case 'index':
default:
$controller = new IndexController();
$controller->afficherAccueil();
break;
}

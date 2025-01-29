<?php
require_once "app/Controller/IndexController.php";
require_once "app/Controller/CollectionController.php";
require_once "app/Controller/AppareilController.php";

$page = $_GET['page'] ?? 'index';

switch ($page) {
    case 'collection':
        (new CollectionController())->afficherCollection($_GET['country'] ?? '');
        break;

    case 'appareil':
        (new AppareilController())->afficherAppareil($_GET['id'] ?? null);
        break;

    default:
        (new IndexController())->afficherAccueil();
        break;
}
?>

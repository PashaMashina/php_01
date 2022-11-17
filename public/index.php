<?php

require_once '../vendor/autoload.php';
require_once "../controllers/MainController.php";
require_once "../controllers/Ti10Controller.php";
require_once "../controllers/Ti10ImageController.php";
require_once "../controllers/Ti10InfoController.php";
require_once "../controllers/Ti11Controller.php";
require_once "../controllers/Ti11ImageController.php";
require_once "../controllers/Ti11InfoController.php";
require_once "../controllers/Controller404.php";

$loader = new \Twig\Loader\FilesystemLoader('../views');

$twig = new \Twig\Environment($loader, [
    "debug" => true
]);

$twig->addExtension(new \Twig\Extension\DebugExtension());

$url = $_SERVER["REQUEST_URI"];

$context = [];

$controller = null;

$pdo = new PDO("mysql:host=localhost;dbname=ti_list;charset=utf8", "root", "");

if ($url == "/") {
    $controller = new MainController($twig);
} elseif (preg_match("#^/ti10/image#", $url)) {
    $controller = new Ti10ImageController($twig);
} elseif (preg_match("#^/ti10/info#", $url)) {
    $controller = new Ti10InfoController($twig);
} elseif (preg_match("#^/ti10#", $url)) {
    $controller = new Ti10Controller($twig);
} elseif (preg_match("#^/ti11/image#", $url)) {
    $controller = new Ti11ImageController($twig);
} elseif (preg_match("#^/ti11/info#", $url)) {
    $controller = new Ti11InfoController($twig);
} elseif (preg_match("#^/ti11#", $url)) {
    $controller = new Ti11Controller($twig);
}

if ($controller) {
    $controller->setPDO($pdo);
    $controller->get();
}
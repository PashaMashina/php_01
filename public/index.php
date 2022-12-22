<?php

require_once '../vendor/autoload.php';
require_once "../framework/autoload.php";
require_once "../controllers/ObjectController.php";
require_once "../controllers/MainController.php";
require_once "../controllers/Controller404.php";
require_once "../controllers/SearchController.php";
require_once "../controllers/TiObjectCreateController.php";
require_once "../controllers/TypeObjectCreateController.php";
require_once "../controllers/TiObjectDeleteController.php";
require_once "../controllers/TiObjectUpdateController.php";

$loader = new \Twig\Loader\FilesystemLoader('../views');

$twig = new \Twig\Environment($loader, [
    "debug" => true
]);

$twig->addExtension(new \Twig\Extension\DebugExtension());

$pdo = new PDO("mysql:host=localhost;dbname=ti_list;charset=utf8", "root", "");

$router = new Router($twig, $pdo);

$router->add("/", MainController::class);
$router->add("/ti-object/(?P<id>\d+)", ObjectController::class); 
$router->add("/search", SearchController::class);
$router->add("/create", TiObjectCreateController::class);
$router->add("/createtype", TypeObjectCreateController::class);
$router->add("/ti-object/(?P<id>\d+)/delete", TiObjectDeleteController::class);
$router->add("/ti-object/(?P<id>\d+)/edit", TiObjectUpdateController::class);


$router->get_or_default(Controller404::class);
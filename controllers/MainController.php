<?php
require_once "BaseTiTwigController.php";

class MainController extends BaseTiTwigController {
    public $template = "main.twig";
    public $title = "Главная";
    
    public function getContext() : array
    {
        $context = parent::getContext(); 

        if(isset($_GET['type'])){
            $query = $this->pdo->prepare("SELECT * FROM ti_objects WHERE parity = :type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();
        }else{
            $query = $this->pdo->query("SELECT * FROM ti_objects");
        }

        $context['ti_objects'] = $query->fetchAll();
         
        return $context;
    }
}
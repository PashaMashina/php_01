<?php
require_once "TwigBaseController.php";

class MainController extends TwigBaseController {
    public $template = "main.twig";
    public $title = "Главная";
    public $main_menu = [
                [
                    "title" => "TI10",
                    "url_title" => "/ti10",
                    "title_image" => "Картина",
                    "url_image" => "/ti10/image",
                    "title_info" => "Описание",
                    "url_info" => "/ti10/info",
                ],
                [
                    "title" => "TI11",
                    "url_title" => "/ti11",
                    "title_image" => "Картина",
                    "url_image" => "/ti11/image",
                    "title_info" => "Описание",
                    "url_info" => "/ti11/info",
                ]
            ];
    public function getContext() : array
    {
        $context = parent::getContext(); 

        $context['main_menu'] = $this->main_menu;

        $query = $this->pdo->query("SELECT * FROM ti_objects");

        $context['ti_objects'] = $query->fetchAll();
         
        return $context;
    }
}
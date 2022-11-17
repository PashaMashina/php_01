<?php
require_once "BaseController.php";

class TwigBaseController extends BaseController {
    public $title = "";
    public $template = "";
    public $menu = [
                        [
                            "title" => "Главная",
                            "microtitle" => "Главная",
                            "url" => "/",
                        ],
                        [
                            "title" => "The International 2021",
                            "microtitle" => "TI10",
                            "url" => "/ti10",
                        ],
                        [
                            "title" => "The International 2022",
                            "microtitle" => "TI11",
                            "url" => "/ti11",
                        ]
                    ];
    protected \Twig\Environment $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }
    
    public function getContext() : array
    {
        $context = parent::getContext(); 
        $context['title'] = $this->title;
        $context['menu'] = $this->menu;
         
        return $context;
    }
    
    public function get() {
        echo $this->twig->render($this->template, $this->getContext());
    }
}

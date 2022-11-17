<?php
require_once "TwigBaseController.php";

class Ti10Controller extends TwigBaseController {
    public $template = "__object.twig";
    public $title = "The International 2021";
    
    public function getContext() : array
    {
        $context = parent::getContext();
        $context['page_image'] = "/ti10/image";
        $context['page_info'] = "/ti10/info";
         
        return $context;
    }
}
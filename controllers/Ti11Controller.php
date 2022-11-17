<?php
require_once "TwigBaseController.php";

class Ti11Controller extends TwigBaseController {
    public $template = "__object.twig";
    public $title = "The International 2022";
    
    public function getContext() : array
    {
        $context = parent::getContext();
        $context['page_image'] = "/ti11/image";
        $context['page_info'] = "/ti11/info";
         
        return $context;
    }
}
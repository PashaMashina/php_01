<?php
require_once "Ti11Controller.php";

class Ti11InfoController extends Ti11Controller {
    public $template = "ti11_info.twig";

    
    public function getContext() : array
    {
        $context = parent::getContext();
        $template = "ti11_info.twig";
        $context['is_info'] = true;
         
        return $context;
    }
}
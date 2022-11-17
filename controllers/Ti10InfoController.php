<?php
require_once "Ti10Controller.php";

class Ti10InfoController extends Ti10Controller {
    public $template = "ti10_info.twig";

    
    public function getContext() : array
    {
        $context = parent::getContext();
        $template = "ti10_info.twig";
        $context['is_info'] = true;
         
        return $context;
    }
}
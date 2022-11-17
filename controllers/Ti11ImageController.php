<?php
require_once "Ti11Controller.php";

class Ti11ImageController extends Ti11Controller {
    public $template = "image.twig";

    
    public function getContext() : array
    {
        $context = parent::getContext();
        $context['image'] = "/images/ti11_place.jpg";
        $context['is_image'] = true;
         
        return $context;
    }
}
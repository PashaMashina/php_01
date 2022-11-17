<?php
require_once "Ti10Controller.php";

class Ti10ImageController extends Ti10Controller {
    public $template = "image.twig";

    
    public function getContext() : array
    {
        $context = parent::getContext();
        $context['image'] = "/images/ti10_place.jpeg";
        $context['is_image'] = true;
         
        return $context;
    }
}
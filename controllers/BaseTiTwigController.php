<?php

class BaseTiTwigController extends TwigBaseController{
    public function getContext(): array
    {
        $context = parent::getContext();
        
        $query = $this->pdo->query("SELECT DISTINCT title FROM types_objects ORDER BY 1");

        // стягиваем одну строчку из базы
        $paritys = $query->fetchAll();
        $context['paritys'] = $paritys;
        
        return $context;
    }
}
<?php

require_once "BaseTiTwigController.php";

class SearchController extends BaseTiTwigController{
    public $template = "search.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';

        $sql = <<<EOL
        SELECT id, title
        FROM ti_objects
        WHERE (:title = '' OR title like CONCAT('%', :title, '%'))
            AND (:type = '' OR parity = :type)
    EOL;

        $query = $this->pdo->prepare($sql);

        $query->bindValue("title", $title);
        $query->bindValue("type", $type);
        $query->execute();

        $context['objects'] = $query->fetchAll();
        $context['title'] = "Поиск";
        $context['is_search'] = true;

        return $context;
    }
}
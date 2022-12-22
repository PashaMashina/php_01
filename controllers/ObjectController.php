<?php
require_once "BaseTiTwigController.php";

class ObjectController extends BaseTiTwigController {
    public $template = "__object.twig"; // указываем шаблон

    public function getContext(): array
    {
        $context = parent::getContext();
        
        // готовим запрос к БД, допустим вытащим запись по id=3
        // тут уже указываю конкретные поля, там более грамотно
        $query = $this->pdo->prepare("SELECT * FROM ti_objects WHERE id = :my_id");
        // подвязываем значение в my_id 
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();
        // стягиваем одну строчку из базы
        $data = $query->fetch();
        
        // передаем описание из БД в контекст
        $context['title'] = $data['title'];
        $context['id'] = $data['id'];
        $context['image'] = $data['image'];
        $context['info'] = $data['info'];

        return $context;
    }

    public function get(array $context) {
        if(isset($_GET['show'])){
            $this->template = "{$_GET['show']}.twig";
        }
        parent::get($context);
    }
}
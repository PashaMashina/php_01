<?php
require_once "BaseTiTwigController.php";

class TiObjectCreateController extends BaseTiTwigController {
    public $template = "ti_object_create.twig";
    public $title = "Добавление";

    public function getContext(): array
    {
        $context = parent::getContext();
        
        $context['is_add'] = true;

        return $context;
    }

    public function post(array $context) { // добавили параметр
        // получаем значения полей с формы
        $title = $_POST['title'];

        $type = $_POST['type'];
        $info = $_POST['info'];

        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name"; // формируем ссылку без адреса сервера
        // создаем текст запрос
        $sql = <<<EOL
INSERT INTO ti_objects(title, parity, info, image)
VALUES(:title, :type, :info, :image_url)
EOL;

        // подготавливаем запрос к БД
        $query = $this->pdo->prepare($sql);
        // привязываем параметры
        $query->bindValue("title", $title);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url);
        // выполняем запрос
        $query->execute();
        
        $context['message'] = 'Вы успешно создали объект';
        $context['id'] = $this->pdo->lastInsertId(); // получаем id нового добавленного объекта
        
        $this->get($context);
    }
}
<?php
require_once "BaseTiTwigController.php";

class TypeObjectCreateController extends BaseTiTwigController {
    public $template = "type_object_create.twig";
    public $title = "Добавление типа";

    public function getContext(): array
    {
        $context = parent::getContext();

        $queryForGet = $this->pdo->query("SELECT * FROM types_objects");
        

        $context['types_objects'] = $queryForGet->fetchAll();
        
        $context['is_add_type'] = true;

        return $context;
    }

    public function post(array $context) { // добавили параметр
        // получаем значения полей с формы
        $title = $_POST['title'];

        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name"; // формируем ссылку без адреса сервера
        // создаем текст запрос
        $sql = <<<EOL
INSERT INTO types_objects(title, image)
VALUES(:title, :image_url)
EOL;

        // подготавливаем запрос к БД
        $query = $this->pdo->prepare($sql);
        // привязываем параметры
        $query->bindValue("title", $title);
        $query->bindValue("image_url", $image_url);
        // выполняем запрос
        $query->execute();
        
        $context['message'] = 'Вы успешно создали объект';
        
        $this->get($context);
    }
}
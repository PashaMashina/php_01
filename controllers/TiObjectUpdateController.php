<?php
require_once "BaseTiTwigController.php";
class TiObjectUpdateController extends BaseTiTwigController
{
    public $template = "ti_object_update.twig";
    public $title = "Редактироваие";

    public function get(array $context) 
    {
        $id = $this->params['id'];

    $sql = <<<EOL
        SELECT * FROM ti_objects WHERE id = :id
        EOL;
        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $id);// echo($id);
        $query->execute();

        $data = $query->fetch();
        $context['object'] = $data;

        parent::get($context);
    }

    public function post(array $context)
    {   
        $id = $_POST['id']  ?? "";
        $title = $_POST['title']  ?? "";
        $type = $_POST['type']  ?? "";
        $info = $_POST['info']  ?? "";

        $tmp_name = $_FILES['image']['tmp_name']  ?? "";
        $name =  $_FILES['image']['name']  ?? "";
        if ($name!='')
        {
            move_uploaded_file($tmp_name, "../public/media/$name");
            $image_url = "/media/$name";
        }
        else
        {
            $image_url = $_POST['imageFix']  ?? "";
        }

        $sql = <<<EOL
        UPDATE ti_objects SET title= :title, image= :image_url, parity= :type, info= :info WHERE id = :id
        EOL;
        
        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $id);
        $query->bindValue("title", $title);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url);
        
        $query->execute();

        $context['message'] = 'Вы успешно изменили объект';
        $this->get($context);

    }
}
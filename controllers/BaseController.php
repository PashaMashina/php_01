<?php
abstract class BaseController {
    public PDO $pdo;

    public function setPDO(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getContext(): array {
        return []; 
    }
    abstract public function get();
}
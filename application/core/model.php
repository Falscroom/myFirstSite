<?php
class Model
{
    public $query; // Содержит не выполненный запрос, чтобы заполнять плэйсхолдеры
    private  $link; // содержит ссылку на обьект PDO
    public $errorCode = 0; // Содержит код ошибки если что-то пошло не так

    public function __construct () {
        try {
            $this->link = new PDO("mysql:host=".HOST.";dbname=".BASENAME."", LOGIN, PASS);
            $this->link->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }
        catch(PDOException $e) {
            $this->errorCode = $e->getCode();
        }
    }
    public function get_data()
    {
    }
    function prepareQuery($query) { // Подгатавливает запрос
        $this->query = $this->link->prepare($query);
    }
    function executeQuery_Simple() { // выполняет запрос и возвращает требуемый результат (ничего, всё, строку)
        try {
        $this->query->execute();
        }
        catch(PDOException $e) {
            return NULL;
        }
        return true;
    }
    function executeQuery_Row() {
        try {
        $this->executeQuery_Simple();
        $arr =  $this->query->fetch();
        return $arr;
        }
        catch(PDOException $e) {
            $this->errorCode = $e->getCode();
        }
        return NULL;
    }
    function executeQuery_All() {
        try{
        $this->executeQuery_Simple();
        $arr =  $this->query->fetchAll();
        return $arr;
        }
        catch(PDOException $e) {
            $this->errorCode = $e->getCode();
        }
        return NULL;
    }

}
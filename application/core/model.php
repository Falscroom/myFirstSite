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
    function get_menu_items() {
        $this->prepareQuery('SELECT lft,rght FROM category WHERE level=0'); // Warning!!!
        $result = $this->executeQuery_Row();

        $left = $result['lft'];
        $right = $result['rght'];

        $this->prepareQuery('SELECT id,name,lft,rght,level FROM category WHERE lft > '.$left.' AND rght < '.$right.' ORDER BY lft'); // Warning!!!
        $result = $this->executeQuery_All();

        $menu_items[1] = array();
        $menu_items[2] = array();
        $menu_items[3] = array();
        $menu_items[4] = array();

        foreach($result AS $arr) {
            if($arr['level'] != 0) array_push($menu_items[$arr['level']],$arr);
        }
        return $menu_items;
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
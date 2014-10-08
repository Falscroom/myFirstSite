<?php
require_once 'dataForDB.php';

class baseConnect {
    public $query;
    private static $_instance = null;
    private  $link;
    public $success = true;
    public $errorCode;

    private function __construct ($host,$login,$pass,$baseName) {
        try {
            $this->link = new PDO("mysql:host=$host;dbname=$baseName", $login, $pass);
            $this->link->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }
        catch(PDOException $e) {
            $this->success = false;
            $this->errorCode = $e->getCode();
        }
    }
    static function getConnect() {
        if(is_null(self::$_instance)) {
            self::$_instance = new self(HOST,LOGIN,PASS,BASENAME);
        }
        return self::$_instance;
    }
    function prepareQuery($query) {
        $this->query = $this->link->prepare($query);
    }
    function executeQuery($type) {
        $this->query->execute();
        switch($type) {
            case 'simple' :
                break;
            case 'all' :
                $arr =  $this->query->fetchAll();
                return $arr;
                break;
            case 'row' :
                $arr =  $this->query->fetch();
                return $arr;
                break;
        }
        return null;
    }
} 
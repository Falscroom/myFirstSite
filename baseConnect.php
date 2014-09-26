<?php
class baseConnect {
    private  $link;
    public $success = true;
    public $errorCode;
    function __construct ($host,$login,$pass,$baseName) {
        try {
            $this->link = new PDO("mysql:host=$host;dbname=$baseName", $login, $pass);
            $this->link->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }
        catch(PDOException $e) {
            $this->success = false;
            $this->errorCode = $e->getCode();
        }
    }
    function execQueryGetAll($query) {
    try {
            $result = $this->link->prepare($query);
            $result->execute();
            $arr =  $result->fetchAll();
    }
    catch(PDOException $e) {
            $this->success = false;
            $this->errorCode = $e->getCode();
            exit();
    }
        return $arr;

    }
    function execQueryGetRow($query) {
        try {
            $result = $this->link->prepare($query);
            $result->execute();
            $arr =  $result->fetch();
            $arr = $arr[0];
        }
        catch(PDOException $e) {
            $this->success = false;
            $this->errorCode = $e->getCode();
            exit();
        }
        return $arr;

    }
    function execSimpleQuery($query) {
    try {
            $result = $this->link->prepare($query);
            $result->execute();
    }
    catch(PDOException $e) {
            $this->success = false;
            $this->errorCode = $e->getCode();
            exit();
    }
    }
} 
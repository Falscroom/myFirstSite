<?php
class Model_Content extends Model
{
    function GetContent($page) {
        $start = $page * 20 - 20;
        $this->prepareQuery('SELECT * FROM item LIMIT :start,20 '); // Warning!!!
        $this->query->bindParam(':start',$start,PDO::PARAM_INT);
        return $this->executeQuery_All();
    }
    function GetCount() {
        $this->prepareQuery('SELECT COUNT(id) FROM item '); // Warning!!!
        return $this->executeQuery_Row();
    }

}
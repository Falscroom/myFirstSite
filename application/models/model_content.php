<?php
class Model_Content extends Model
{
    function GetContent($page,$category) {
    try {
            $start = $page * 20 - 20;
            $this->prepareQuery('SELECT * FROM item WHERE category_id=:category LIMIT :start,20'); // Warning!!!
            $this->query->bindParam(':start',$start,PDO::PARAM_INT);
            $this->query->bindParam(':category',$category,PDO::PARAM_INT);
            return $this->executeQuery_All();
    } catch(PDOException $e) {
            Route::ErrorPage404();
    }
    }
    function GetCount($category) {
        $this->prepareQuery('SELECT COUNT(id) FROM item WHERE category_id=:category'); // Warning!!!
        $this->query->bindParam(':category',$category,PDO::PARAM_INT);
        return $this->executeQuery_Row();
    }

    function create_node($new_level,$new_name,$parent_name) {

        $this->prepareQuery('SELECT id,rght FROM category WHERE level=:level - 1 AND name=:name'); // Warning!!!
        $this->query->bindParam(':level',$new_level,PDO::PARAM_INT);
        $this->query->bindParam(':name',$parent_name,PDO::PARAM_STR);
        /////////////////////
        $result =  $this->executeQuery_Row();
        $right = $result['rght'];
        /////////////////////
        $this->prepareQuery('UPDATE category SET lft = lft + 2 WHERE lft >= :right');
        $this->query->bindParam(':right',$right,PDO::PARAM_INT);
        $this->executeQuery_Simple();
        /////////////////////
        $this->prepareQuery('UPDATE category SET rght = rght + 2 WHERE rght >= :right');
        $this->query->bindParam(':right',$right,PDO::PARAM_INT);
        $this->executeQuery_Simple();
        /////////////////////
        $this->prepareQuery('INSERT INTO category SET name=:new_name , level = :level , lft=:right , rght=:right + 1'); // FIXME parent_id
        $this->query->bindParam(':level',$new_level,PDO::PARAM_INT);
        $this->query->bindParam(':right',$right,PDO::PARAM_INT);
        $this->query->bindParam(':new_name',$new_name,PDO::PARAM_STR);
        $this->executeQuery_Simple();
    }
    function get_menu_items() {
        $this->prepareQuery('SELECT lft,rght FROM category WHERE level=0'); // Warning!!!
        $result = $this->executeQuery_Row();

        $left = $result['lft'];
        $right = $result['rght'];

        $this->prepareQuery('SELECT name,lft,rght,level FROM category WHERE lft > '.$left.' AND rght < '.$right.' ORDER BY lft'); // Warning!!!
        return $this->executeQuery_All();

    }
    function delete_node($level,$name) {
        $this->prepareQuery('SELECT id,lft,rght FROM category WHERE level=:level AND name=:name'); // Warning!!!
        $this->query->bindParam(':level',$level,PDO::PARAM_INT);
        $this->query->bindParam(':name',$name,PDO::PARAM_STR);
        $result = $this->executeQuery_Row();

        $left = $result['lft'];
        $right = $result['rght'];
        $current_id = $result['id'];

        if(!$result)return NULL; //ДЛЯ СИТУЕВИНЫ, ЕСЛИ ТАКОГО УЗЛА ВООБЩЕ НЕТ!

        $this->prepareQuery('SELECT id FROM category WHERE level=:level + 1 AND lft > :left AND rght < :right'); // Warning!!!
        $this->query->bindParam(':left',$left,PDO::PARAM_INT);
        $this->query->bindParam(':right',$right,PDO::PARAM_INT);
        $this->query->bindParam(':level',$level,PDO::PARAM_INT);


        switch($level) {
            case 0: // ЭТО HEAD
                echo 'ТИ ЧТО ДЕЛАЕШЬ?!';
                return false;
                //FIXME stupid case
                break;
            default: // УПС, ЭТО НЕ HEAD
                if($this->executeQuery_All()) { // УПС, ДА У НЕГО ЕЩЁ И ПОТОМКИ ЕСТЬ
                    $this->prepareQuery("DELETE FROM category WHERE id=:current_id");
                    $this->query->bindParam(':current_id',$current_id,PDO::PARAM_INT);

                    if($this->executeQuery_Simple()) {
                        $this->prepareQuery('UPDATE category SET level = level - 1 WHERE lft > :left AND rght < :right ');
                        $this->query->bindParam(':left',$left,PDO::PARAM_INT);
                        $this->query->bindParam(':right',$right,PDO::PARAM_INT);
                        $this->executeQuery_Simple();

                        $this->prepareQuery('UPDATE category SET lft = lft - 1,rght = rght - 1 WHERE lft > :left AND rght < :right');
                        $this->query->bindParam(':left',$left,PDO::PARAM_INT);
                        $this->query->bindParam(':right',$right,PDO::PARAM_INT);
                        $this->executeQuery_Simple();

                        $this->prepareQuery('UPDATE category SET lft = lft - 2 WHERE lft > :left');
                        $this->query->bindParam(':left',$left,PDO::PARAM_INT);
                        $this->executeQuery_Simple();

                        $this->prepareQuery('UPDATE category SET rght = rght - 2 WHERE rght > :right');
                        $this->query->bindParam(':right',$right,PDO::PARAM_INT);
                        $this->executeQuery_Simple();
                        return true;
                    }
                    return false;
                }
                else { //НУ ХОТЯ БЫ ПОТОМКОВ НЕТ
                    $this->prepareQuery("DELETE FROM category WHERE id=:current_id");
                    $this->query->bindParam(':current_id',$current_id,PDO::PARAM_INT);
                    if($this->executeQuery_Simple()) { // Если его вообще можно удалять... а то вдруг у него детки

                        $this->prepareQuery('UPDATE category SET lft = lft - 2 WHERE lft > :left');
                        $this->query->bindParam(':left',$left,PDO::PARAM_INT);
                        $this->executeQuery_Simple();
                        /////////////////////
                        $this->prepareQuery('UPDATE category SET rght = rght - 2 WHERE rght > :right');
                        $this->query->bindParam(':right',$right,PDO::PARAM_INT);
                        $this->executeQuery_Simple();
                        echo 'удалять можно';
                        return true;
                    }
                    return false;
                }
                break;
        }
    }

}
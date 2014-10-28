<?php
class Authorization extends Model {
    static function logOut() {
        if(isset($_COOKIE['hash'])) {
            setcookie("id", "", time() - TIME*12);
            setcookie("hash", "", time() - TIME*12);
            setcookie("login", "", time() - TIME*12);
        }
    }
    public function mainApproveLogin() {
        if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
        {
            $this->prepareQuery("SELECT * FROM user WHERE id = :id LIMIT 1");
            $this->query->bindParam(':id',intval($_COOKIE['id']));
            $userData = $this->executeQuery_Row();

            if(($userData['hash'] !== $_COOKIE['hash']) or ($userData['id'] !== $_COOKIE['id'])
                or ((long2ip($userData['ip']) !== $_SERVER['REMOTE_ADDR'])  and ($userData['ip'] !== "0")))
            {   #в этом случае сносим существующие куки
                Authorization::logOut();
                return false;
            }
            else
            {
                return true;
            }
        }
        else {
            return false;
        }
    }
}
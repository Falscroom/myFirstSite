<?php
class Authorization extends Model {
    public function mainApproveLogin() {
        if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
        {
            $this->prepareQuery("SELECT * FROM user WHERE id = :id LIMIT 1");
            $this->query->bindParam(':id',intval($_COOKIE['id']));
            $userData = $this->executeQuery('row');

            if(($userData['hash'] !== $_COOKIE['hash']) or ($userData['id'] !== $_COOKIE['id'])
                or ((long2ip($userData['ip']) !== $_SERVER['REMOTE_ADDR'])  and ($userData['ip'] !== "0")))
            {   #в этом случае сносим существующие куки
                setcookie("id", "", time() - TIME*12);
                setcookie("hash", "", time() - TIME*12);
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
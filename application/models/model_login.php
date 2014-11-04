<?php
class Model_Login extends Model
{
    private $thisUser;
    private $hash;
    public  $errors = array();

    private function generateCode($length=6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }
    public function checkPass($pass,$login) {
        $this->prepareQuery('SELECT user_id, password ,login FROM user WHERE login=:login LIMIT 1'); // Warning!!!
        $this->query->bindParam(':login',$login);
        $this->thisUser = $this->executeQuery_Row();
        if($this->thisUser["password"] === md5(md5($pass))) {
            return true;
        }
        return false;
    }
    private function createCookie() {
        setcookie("user_id", $this->thisUser['user_id'], time()+TIME);
        setcookie("hash", $this->hash, time()+TIME);
        setcookie("login", $this->thisUser['login'], time()+TIME);
    }

/*    function deleteOldSessions() {
        // То есть удаляем устаревшие сессии полбзователя, что логинится СЕЙЧАС
        $this->prepareQuery("DELETE FROM sessions WHERE user_id=:id AND time <  ".time()." "); // FIXME
        $this->query->bindParam(':id',$this->thisUser['user_id']);
        $this->executeQuery_Simple();
    }*/

    function approveUser($login,$pass,$createIP) {
        if($this->checkPass($pass,$login)) { #ПРОВЕРЯЕМ ПРАВИЛЬНОСТЬ ПАРОЛЯ
            $ip = 0;
            $time = time() + 60 * 2;

            $this->hash = md5($this->generateCode(10));
            if($createIP) {
                $ip =  ip2long($_SERVER['REMOTE_ADDR']);
            }
            $this->prepareQuery("INSERT INTO sessions SET user_id=:id, time=:time, hash=:hash, ip=:ip");
            /*$this->prepareQuery("UPDATE user SET hash=:hash, ip=:ip WHERE id=:id");*/
            $this->query->bindParam(':hash',$this->hash);
            $this->query->bindParam(':ip',$ip);
            $this->query->bindParam(':id',$this->thisUser['user_id']);
            $this->query->bindParam(':time',$time); // Два часа!
            $this->executeQuery_Simple();

            $this->createCookie(); // Создаем куки
/*            $this->deleteOldSessions(); // Удаляем устаревшие сессии*/
            return true;
        }
        else {
            $this->errors['password_login'] = 'has-error'; // class из bootstrap
            Authorization::logOut();
            return false;
        }
    }
}
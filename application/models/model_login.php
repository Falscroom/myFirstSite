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
        $this->prepareQuery('SELECT id, password ,login FROM user WHERE login=:login LIMIT 1'); // Warning!!!
        $this->query->bindParam(':login',$login);
        $this->thisUser = $this->executeQuery_Row();
        if($this->thisUser["password"] === md5(md5($pass))) {
            return true;
        }
        return false;
    }
    private function createCookie() {
        setcookie("id", $this->thisUser['id'], time()+TIME);
        setcookie("hash", $this->hash, time()+TIME);
        setcookie("login", $this->thisUser['login'], time()+TIME);
    }
    private function deleteCookie() {
        if(isset($_COOKIE['id']) or isset($_COOKIE['hash'])) {
            setcookie("id", "", time() - TIME*12);
            setcookie("hash", "", time() - TIME*12);
            setcookie("login", "", time() - TIME*12);
        }
    }
    function approveUser($login,$pass,$createIP) {
        if($this->checkPass($pass,$login)) { #ПРОВЕРЯЕМ ПРАВИЛЬНОСТЬ ПАРОЛЯ
            $this->hash = md5($this->generateCode(10));
            if($createIP) {
                $ip =  ip2long($_SERVER['REMOTE_ADDR']);
            }
            else {
                $ip = 0;
            }
            $this->prepareQuery("UPDATE user SET hash=:hash, ip=:ip WHERE id=:id");
            $this->query->bindParam(':hash',$this->hash);
            $this->query->bindParam(':ip',$ip);
            $this->query->bindParam(':id',$this->thisUser['id']);
            $this->executeQuery_Simple();
            $this->createCookie();
            return true;
        }
        else {
            $this->errors['password_login'] = 'has-error'; // class из bootstrap
            $this->deleteCookie();
            return false;
        }
    }
}
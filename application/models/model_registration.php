<?php
class Model_Registration extends Model
{
    private function checkWithRegularExp($login) {
        if(!preg_match("/^[a-zA-Z0-9]+$/",$login))
        {
            return false;
        }
        if(strlen($login) < 3 or strlen($login) > 30)
        {
            return false;
        }
        return true;
    }
    private function checkUserInDB($login) {
        $this->prepareQuery("SELECT COUNT(id) FROM user WHERE login=:login");
        $this->query->bindParam(':login',$login);
        $data =  $this->executeQuery('row');
        if($data[0] > 0)
        {
            return false;
        }
        return true;
    }

    public function addUser($login,$password,$contacts) {
        if($this->checkUserInDB($login) && $this->checkWithRegularExp($login)) {
            $password = md5(md5(trim($password)));
            $this->prepareQuery("INSERT INTO user SET login='".$login."', password='".$password."',contacts=:contacts");
            $this->query->bindParam(':contacts',$contacts);
            $this->executeQuery('simple');
        }
    }
}
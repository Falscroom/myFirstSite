<?php
class Model_Registration extends Model
{
    public $errors = array();
    private function checkWithRegularExp($login) {
        if(!preg_match("/^[a-zA-Z0-9]+$/",$login))
        {
            $this->errors['login_error'] = 'has-error';
            $this->errors['login_text'] = 'Логин содержит недопустимые символы';

            return false;
        }
        if(strlen($login) < 3 or strlen($login) > 30)
        {

            $this->errors['login_error'] = 'has-error';
            $this->errors['login_text'] = 'Логин должен быть не короче 3, но не больше 30 символов';

            return false;
        }
        return true;
    }
    private function checkUserInDB($login) {
        $this->prepareQuery("SELECT COUNT(user_id) FROM user WHERE login=:login");
        $this->query->bindParam(':login',$login);
        $data =  $this->executeQuery_Row();
        if($data[0] > 0)
        {

            $this->errors['login_error'] = 'has-error';
            $this->errors['login_text'] = 'Такой пользователь уже есть';

            return false;
        }
        return true;
    }
    private function checkPass($password,$password2) {
        if($password != $password2) {

            $this->errors['password_error'] = 'has-error';
            $this->errors['password_text'] = "Пароли не совпадают";

            return false;
        }
        if(strlen($password) < 4 || strlen($password) > 30) {

            $this->errors['password_error'] = 'has-error';
            $this->errors['password_text'] = "Пароль должен быть длиннее 4 символов, но корчое 30";

            return false;
        }
        return true;
    }

    public function addUser($login,$password,$contacts,$password2) {
        if($this->checkUserInDB($login) && $this->checkWithRegularExp($login) && ($this->checkPass($password,$password2))) {
            $password = md5(md5(trim($password)));
            $this->prepareQuery("INSERT INTO user SET login=:login, password=:password,contacts=:contacts");
            $this->query->bindParam(':login',$login);
            $this->query->bindParam(':password',$password);
            $this->query->bindParam(':contacts',$contacts);
            $this->executeQuery_Simple();
            return true;
        }
        else {
            return false;
        }
    }
}
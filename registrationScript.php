<?
require_once 'baseConnect.php';
/*$connect = baseConnect::getConnect();
if(isset($_POST['submit']))
{
    $error = true;
    # проверям логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $error = false;
    }
    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $error = false;
    }
    # проверяем, не сущестует ли пользователя с таким именем

    $connect->prepareQuery("SELECT COUNT(id) FROM user WHERE login=:login");
    $connect->query->bindParam(':login',$_POST['login']);
    $query = $connect->executeQuery('row');

    if($query[0] > 0)
    {
        $error = false;
    }


    # Если нет ошибок, то добавляем в БД нового пользователя
    if($error)
    {
        $login = $_POST['login'];
        $contacts = $_POST['contacts'];
        # Убераем лишние пробелы и делаем двойное шифрование
        $password = md5(md5(trim($_POST['password'])));

        $connect->prepareQuery("INSERT INTO user SET login='".$login."', password='".$password."',contacts=:contacts");
        $connect->query->bindParam(':contacts',$contacts);
        $query = $connect->executeQuery('row');

        header("Location:index.php"); exit();
    }
}*/
class registration_controller {
    private $connect;
    static private $thisController=null;
    function __construct() {
        $this->connect = baseConnect::getConnect();
    }
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
     private  function checkUserInDB($login) {
        #var_dump(self::$connect);
        $this->connect->prepareQuery("SELECT COUNT(id) FROM user WHERE login=:login");
        $this->connect->query->bindParam(':login',$login);
        $result =  $this->connect->executeQuery('row');
        if($result[0] > 0)
        {
            return true;
        }
        else {
            return false;
        }
    }
    static public  function getController() {
        if(is_null(self::$thisController)) {
            self::$thisController = new self();
        }
        return self::$thisController;
    }
    public function addUser($login,$password,$contacts) {
        if(!self::checkUserInDB($login) && self::checkWithRegularExp($login)) {
            $password = md5(md5(trim($password)));
            $this->connect->prepareQuery("INSERT INTO user SET login='".$login."', password='".$password."',contacts=:contacts");
            $this->connect->query->bindParam(':contacts',$contacts);
            $this->connect->executeQuery('simple');

            header("Location:index.php"); exit();
        }
    }
}
    $controller = registration_controller::getController();
    $controller->addUser($_POST['login'],$_POST['password'],$_POST['contacts']);
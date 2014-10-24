<?
require_once 'baseConnect.php';

/*// Страница авторизации
# Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
        $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

# Соединямся с БД
$connect = new baseConnect($host,$login,$pass,$baseName);
if(isset($_POST['submit']))
{
    # Вытаскиваем из БД запись, у которой логин равняеться введенному
    $data = $connect->execQueryGetRow("SELECT id, password FROM user WHERE login='".mysql_real_escape_string($_POST['login'])."' LIMIT 1");
    if($data["password"] === md5(md5($_POST['password'])))
    {
        # Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));
        if(!@$_POST['not_attach_ip'])
        {
            echo "ip create";
            $ip = ip2long($_SERVER['REMOTE_ADDR']);
        }
        else {
            echo "ip net";
            $ip = 0;
        }
        # Записываем в БД новый хеш авторизации и IP
        $connect->execSimpleQuery("UPDATE user SET hash='".$hash."', ip='".$ip."' WHERE id='".$data['id']."'");
        # Ставим куки
        setcookie("id", $data['id'], time()+TIME);
        setcookie("hash", $hash, time()+TIME);
        # Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location:check.php"); exit();
    }
}*/

class login_controller {
    private $connect;
    private $ip = 0;
    private $thisUser;
    private $hash;

    static private $thisController=null;

    private function __construct() {
        $this->connect = baseConnect::getConnect();
    }
    static public function getController() {
        if(is_null(self::$thisController)) {
            self::$thisController = new self();
        }
        return self::$thisController;
    }
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
        $this->connect->prepareQuery('SELECT id, password FROM user WHERE login=:login LIMIT 1');
        $this->connect->query->bindParam(':login',$login);
        $this->thisUser = $this->connect->executeQuery('row');
        if($this->thisUser["password"] === md5(md5($pass))) {
            return true;
        }
        return false;
    }
    private function createIP() {
        $this->ip =  ip2long($_SERVER['REMOTE_ADDR']);
    }
    private function createCookie() {
        setcookie("id", $this->thisUser['id'], time()+TIME);
        setcookie("hash", $this->hash, time()+TIME);

        header("Location:check.php"); exit();
    }
    private function deleteCookie() {
        if(isset($_COOKIE['id']) or isset($_COOKIE['hash'])) {
        setcookie("id", "", time() - TIME*12);
        setcookie("hash", "", time() - TIME*12);
        }
    }
/*    public function mainApproveLogin() {
        if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
        {
            $this->connect->prepareQuery("SELECT * FROM user WHERE id = :id LIMIT 1");
            $this->connect->query->bindParam(':id',intval($_COOKIE['id']));
            $userData = $this->connect->executeQuery('row');
            if(($userData['hash'] !== $_COOKIE['hash']) or ($userData['id'] !== $_COOKIE['id'])
                or ((long2ip($userData['ip']) !== $_SERVER['REMOTE_ADDR'])  and ($userData['ip'] !== "0")))
            {   #в этом случае сносим существующие куки
                $this->deleteCookie();
                echo 'Что то не так';
                if(($userData['hash'] !== $_COOKIE['hash'])) {
                    echo 'с хэшом все норм';
                }
            }
            else
            {
                print "Hello, ".$userData['login'].". allrght!";
            }
    }
    }*/
    function approveUser($login,$pass,$createIP) {
        if($this->checkPass($pass,$login)) { #ПРОВЕРЯЕМ ПРАВИЛЬНОСТЬ ПАРОЛЯ
        $this->hash = md5($this->generateCode(10));
        if($createIP) {
            $this->createIP();
        }
        $this->connect->prepareQuery("UPDATE user SET hash=:hash, ip=:ip WHERE id=:id");
        $this->connect->query->bindParam(':hash',$this->hash);
        $this->connect->query->bindParam(':ip',$this->ip);
        $this->connect->query->bindParam(':id',$this->thisUser['id']);
        $this->connect->executeQuery('simple');
        $this->createCookie();
        }
        else {
           # echo "Пароль не верен";
            $this->deleteCookie();
        }
    }
}
if(isset($_POST['submit'])) {
    $createIP = true;
    if(isset($_POST['not_attach_ip'])) {
        $createIP = false;
    }
    $controller = login_controller::getController();
    $controller->approveUser($_POST['login'],$_POST['password'],$createIP);
    #$controller->mainApproveLogin();
}

<?
require_once 'baseConnect.php';

/*$connect = new baseConnect($host,$login,$pass,$baseName);
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    $userData = $connect->execQueryGetRow("SELECT * FROM user WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
    if(($userData['hash'] !== $_COOKIE['hash']) or ($userData['id'] !== $_COOKIE['id'])
        or ((long2ip($userData['ip']) !== $_SERVER['REMOTE_ADDR'])  and ($userData['ip'] !== "0")))
    {
//        setcookie("id", "", time() - 3600*24*1*12, "/");
//        setcookie("hash", "", time() - 3600*24*1*12, "/");
        setcookie("id", "", time() - 3600*24*1*12);
        setcookie("hash", "", time() - 3600*24*1*12);
        print "Wrong!";
    }
    else
    {
        print "Hello, ".$userData['login'].". allrght!";
    }
}*/

class mainChecker {
    private $connect;
    static public $thisController=null;
    private function __construct() {
        $this->connect = baseConnect::getConnect();
    }
    static public function getController() {
        if(is_null(self::$thisController)) {
            self::$thisController = new self();
        }
        return self::$thisController;
    }
    public function mainApproveLogin() {
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
}
}
$controller = mainChecker::getController();
$controller->mainApproveLogin();

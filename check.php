<?
include 'baseConnect.php';
include 'dataForDB.php';

$connect = new baseConnect($host,$login,$pass,$baseName);
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    $userData = $connect->execQuery("SELECT * FROM user WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
    if(($userData['hash'] !== $_COOKIE['hash']) or ($userData['id'] !== $_COOKIE['id'])
        or (($userData['ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userData['ip'] !== "0")))
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        print "Wrong!";
    }
    else
    {
        print "Hello, ".$userData['login'].". allrght!";
    }
}
else
{
    print "On your cookie";
}
?>

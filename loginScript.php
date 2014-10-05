<?
include 'baseConnect.php';
include 'dataForDB.php';

// Страница авторизации
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
        var_dump($ip);
        $connect->execSimpleQuery("UPDATE user SET hash='".$hash."', ip='".$ip."' WHERE id='".$data['id']."'");
        # Ставим куки
        setcookie("id", $data['id'], time()+60*60*24*1);
        setcookie("hash", $hash, time()+60*60*24*1);
        # Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location:check.php"); exit();
    }
    else
    {
//        setcookie("id", "", time() - 3600*24*1*12);
//        setcookie("hash", "", time() - 3600*24*1*12);
        print '<div class="text">Your login or pass not right</div>';
    }
}

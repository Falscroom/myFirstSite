<?
include 'baseConnect.php';
include 'dataForDB.php';

$connect = new baseConnect($host,$login,$pass,$baseName);
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
    $query = $connect->execQueryGetRow("SELECT COUNT(id) FROM user WHERE login='".mysql_real_escape_string($_POST['login'])."'");
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
        $connect->execSimpleQuery("INSERT INTO user SET login='".$login."', password='".$password."',contacts='".$contacts."'");
        header("Location:index.php"); exit();
    }
}
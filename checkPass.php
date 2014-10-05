<?php

include 'baseConnect.php';
include 'dataForDB.php';
$connect = new baseConnect($host,$login,$pass,$baseName);

$data = $connect->execQueryGetRow("SELECT id, password FROM user WHERE login='".mysql_real_escape_string($_POST['l'])."' LIMIT 1");
if($data["password"] === md5(md5($_POST['p'])))
{
    echo false;
}
else {
    echo true;
}
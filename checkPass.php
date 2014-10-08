<?php

include 'baseConnect.php';
$connect = baseConnect::getConnect();

$connect->prepareQuery("SELECT id, password FROM user WHERE login=:login LIMIT 1");
$connect->query->bindParam(':login',$_POST['l']);
$data = $connect->executeQuery('row');

if($data["password"] === md5(md5($_POST['p'])))
{
    echo false;
}
else {
    echo true;
}
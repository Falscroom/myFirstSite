<?php
include 'baseConnect.php';

$connect = baseConnect::getConnect();

$connect->prepareQuery("SELECT COUNT(id) FROM user WHERE login=:login");
$connect->query->bindParam(':login',$_POST['l']);
$data = $data = $connect->executeQuery('row');
if($data[0] > 0)
{
    echo false;
}
else {
    echo true;
}
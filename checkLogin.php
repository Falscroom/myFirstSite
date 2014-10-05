<?php

include 'baseConnect.php';
include 'dataForDB.php';
$connect = new baseConnect($host,$login,$pass,$baseName);

$query = $connect->execQueryGetRow("SELECT COUNT(id) FROM user WHERE login='".mysql_real_escape_string($_POST['l'])."'");
if($query[0] > 0)
{
    echo false;
}
else {
    echo true;
}
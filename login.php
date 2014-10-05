<? ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet" media="screen">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="js/loginFormChecker.js"></script>
</head>
<body>
<?php include 'loginScript.php';  ob_end_flush(); ?>
<div id="formWrapper" >
    <form class="form-horizontal" method="post" id="loginForm">
        <div class="field">
            <label for="login">Логин</label>
            <input type="text" id="login" name="login" />
        </div>
        <div class="field">
            <label for="pass">Пароль</label>
            <input type="password" id="pass" name="password" />
        </div>
        <div  class="field">
            <label for="id_attach">Не прикреплять к ip</label>
            <input type="checkbox" name="not_attach_ip" id="id_attach">
        </div>
            <div class="controls">
                <button type="submit" name="submit" class="btn" >Войти</button>
            </div>
    </form>
</div>
</body>
</html>
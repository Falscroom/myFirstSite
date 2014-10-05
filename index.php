<?php include 'registrationScript.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet" media="screen">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="js/registrationFormChecker.js"></script>
</head>
<body>
<!--Форма регистрации-->
    <div id="formWrapper">
        <form class="form-horizontal" method="post" id="registrationForm">
            <div class="field">
                <label for="login">Логин</label>
                <input type="text" id="login" name="login" />
            </div>
            <div class="field">
                <label for="pass">Пароль</label>
                <input type="password" id="pass" name="password" />
            </div>
            <div class="field">
                <label for="contacts">Контакты</label>
                <input type="text" id="contacts" name="contacts" />
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" name="submit" class="btn">Зарегестрироваться</button>
                </div>
            </div>
        </form>
    </div>

</body>
</html>
<!--А НУ НЕ СМЕТЬ КОПИПАСТИТЬ МОЮ ДОМАШКУ!!!!-->
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
</head>
<body>
    <?php include 'registrationScript.php';  ob_end_flush(); ?>
    <div id="formWrapper" >
        <form class="form-horizontal" method="post">
            <div class="field">
                <label for="n">Логин</label>
                <input type="text" id="n" name="login" />
            </div>
            <div class="field">
                <label for="ln">Password</label>
                <input type="password" id="ln" name="password" />
            </div>
            <div class="field">
                <label for="a">Contacts</label>
                <input type="text" id="a" name="contacts" />
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" name="submit" class="btn">Register</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
<!--Форма регистрации-->
<!--<div id="formWrapper">
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
</div>-->

<div id="ac_register_form">
    <form class="form-horizontal" method="post">

        <div class="form-group  <?= $data['login_error'] ?>">
            <label class="control-label" for="login">Логин</label>
            <input type="text" class="form-control" id="login" name="login" />
        </div>

        <?= $data['login_text'] ?>

        <div class="form-group <?= $data['password_error'] ?>">
            <label class="control-label" for="pass">Пароль </label>
            <input class="form-control" type="password" id="pass" name="password" />
        </div>

        <?= $data['password_text'] ?>

        <div class="form-group ">
            <label class="control-label" for="password2">Повторите пароль </label>
            <input class="form-control" type="text" id="password2" name="password2" />
        </div>

        <div class="form-group ">
            <label class="control-label" for="contacts">Контакты </label>
            <input class="form-control" type="text" id="contacts" name="contacts" />
        </div>
        <div class="controls">
            <button type="submit" name="submit" class="btn" >Зарегестрироваться</button>
        </div>
    </form>
    <div id="text"> <a href="login"> Войти </a> </div>
</div>
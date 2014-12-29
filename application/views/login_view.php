<div id="ac_login_form">
    <form class="form-horizontal" method="post">


        <div class="form-group <?=$data['errors']['password_login']?>">
            <label class="control-label" for="login">Логин</label>
            <input type="text" class="form-control" id="login" name="login" />
        </div>



        <div class="form-group <?=$data['errors']['password_login']?>">
            <label class="control-label" for="pass">Пароль </label>
            <input class="form-control" type="password" id="pass" name="password" />
        </div>

        <div  class="field">
            <label for="id_attach">Не прикреплять к ip</label>
            <input type="checkbox" name="not_attach_ip" id="id_attach">
        </div>
        <div class="controls">
            <button type="submit" name="submit" class="btn" >Войти</button>
        </div>
    </form>
            <div id="text"> <a href="registration"> Ещё не зарегестрированы? </a> </div>
</div>
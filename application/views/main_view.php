
<!--<div id="ac_background" class="ac_background">
    <div class="ac_overlay"></div>
</div>-->

<div id="ac_header">
    <?php if ($data['authorization']): ?>
        <a href=""> <?= $_COOKIE['login'] ?> </a>
    <? else: ?>
    <a href="login"> Войти </a>
    <? endif; ?>
</div>
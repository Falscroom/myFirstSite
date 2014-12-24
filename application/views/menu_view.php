<div id="ac_content" class="ac_content">
    <h1><span>MySite</span>vottak</h1>
    <div class="ac_menu">
        <div class="menu_container">
            <div class="menu_row">
                <a   class="menu_items" href="main">На главную</a>
                <?php foreach($data['menu_items'] as $arr): ?>
                    <? if($arr['level'] == 1)echo '<div class="menu_items">' . $arr['name'] . '</div>';?>
                <?php endforeach; ?>
<!--                <div class="menu_items">Элемент</div>
                <div class="menu_items">Элемент1</div>-->
            </div>
        </div>
        <ul>
            <?//FIXME ?>


                        <?php foreach($data['menu_items'] as $arr): ?>
                            <? if($arr['level'] == 1) echo '
                                         <li>
                                            <div class="ac_subitem">
                                                <span class="ac_close_base ac_close"></span>
                                                <h2>'.$arr['name'].'</h2>
                                                <ul>';
                            if($arr['level'] == 1 && $old_level == 2) echo '
                                                </ul>
                                            </div>
                                        </li>
                            ';
                            ?>
                        <?php endforeach; ?>



        </ul>
    </div>
</div>
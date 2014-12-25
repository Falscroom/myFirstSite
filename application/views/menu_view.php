<div id="ac_content" class="ac_content">
    <h1><span>MySite</span>vottak</h1>
    <div class="ac_menu">
        <div class="menu_container">
            <div class="menu_row">
                <a   class="menu_items" href="main">На главную</a>
                <?php foreach($data['menu_items'][1] as $arr): ?>
                    <div class="menu_items"><?=$arr['name']?></div>
                <?php endforeach; ?>
            </div>
        </div>

        <ul>

            <? foreach($data['menu_items'][1] as $arr): ?>
            <li>
                <div class="ac_subitem">
                    <span class="ac_close_base ac_close"></span>
                    <h2><?=$arr['name']?></h2>
                    <ul>
                        <li></li>
                    <? foreach($data['menu_items'][2] as $arr_level_two): ?>
                            <? if($arr_level_two['lft'] > $arr['lft'] && $arr_level_two['rght'] < $arr['rght']): ?>
                            <div class="ac_subitem_level_three">
                                <li><?=$arr_level_two['name']?></li>
                                <div class="ac_under_subitem">
                                    <ul>
                                        <li> 11 </li>
                                        <li> 22 </li>
                                    </ul>
                                </div>
                            </div>
                            <? endif ?>
                    <? endforeach; ?>
                    </ul>
                </div>
            </li>
            <? endforeach; ?>


        </ul>
    </div>
</div>
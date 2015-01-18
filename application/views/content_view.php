<div class="container">
    <div id="gt-grid" class="gt-grid">
       <? foreach($data['item'] as $arr) : ?>
            <div>
                <img src="/myFirstSite/images/<?=$arr['image']?>">
                <input type="hidden" value="<?=$arr['id']?>">
                <div class="horizontal_line"> <span>Описание </span> </div>
                <div class="down_line"> <span> Цена : <?=$arr['price']?> </span> <span class="buy">| Купить </span> </div>
                    <div class="description">
                        <div class="name"><?=$arr['name']?></div>
                        <span><?=$arr['description']?></span>
                        <div class="ac_close_base close_description"></div>
                    </div>
            </div>
       <? endforeach ?>
    </div>
</div>
<?php
    $pagination = new Pagination();
    $pagination->createPagination($data['number_of_pages'],20,$data['current_page'],$data['category'])
?>
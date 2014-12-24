


<div class="container">
    <div id="gt-grid" class="gt-grid">
        <?php
        foreach($data['item'] as $arr) {
            echo '<div>
                <img src="/myFirstSite/images/'.$arr['image'].'">';
                echo '<div class="horizontal_line"> <span>Описание </span> </div>';
                echo '<div class="down_line"> <span> Цена : '.$arr['price'].' </span> <span class="buy">| Купить </span> </div>';
                echo
                    '<div class="description">
                        <div class="name">'.$arr['name'].'</div>
                        <span>'.$arr['description'].'</span>
                        <div class="ac_close_base close_description"></div>
                    </div>';
            echo '</div>';
        }
        ?>
    </div>
</div>
<?php
    $pagination = new Pagination();
    $pagination->createPagination($data['number_of_pages'],20,$data['current_page'],$data['category'])
?>
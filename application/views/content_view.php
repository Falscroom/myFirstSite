<div class="container">
    <div id="gt-grid" class="gt-grid">
        <?php foreach($data['item'] as $arr) {
            echo '<div><img src="/myFirstSite/images/'.$arr['image'].'">';
                echo '<div class="horizontal_line"> <span>Описание </span> </div>';
                echo '<div class="down_line"> <span> Цена : '.$arr['price'].' </span> <span class="buy">| Купить </span> </div>';
            echo '</div>';
        }
        ?>
    </div>
</div><!-- /container -->
<div id="footer">
    <!-- Larger pagination -->

   <?
   $pag = new Pagination($data['pag'][1],20,$data['pag'][0]);
   $pag->createPagination();
   ?>

</div>
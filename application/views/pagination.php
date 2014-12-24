<?php
class Pagination {
    function createPagination($number_of_items,$items_on_page,$current_page,$category) {

        $link = "http://localhost/myFirstSite/content/category/page/".$category.'/';

        $number_of_pages = ceil($number_of_items/$items_on_page);
        $prev_next = 3;

        $start = max(1, $current_page - $prev_next);
        $end = min($number_of_pages, $current_page + $prev_next);

        echo '<div id="footer">';

        if($start > 1) {
            echo "<span><a href='{$link}1'>1</a></span>";
        }

        if($current_page - 2 > $prev_next) {
            echo "<span>...</span>";
        }

        for($i = $start; $i <= $end; $i++) {
            if($i == $current_page) {
                echo '<span>'.$current_page.'</span>';
            }
            else {
                echo "<span><a href='{$link}{$i}'>{$i}</a></span>";
            }
        }

        if($number_of_pages - $current_page - 1 > $prev_next) {
            echo "<span>...</span>";
        }

        if($end < $number_of_pages) {
            echo "<span><a href='{$link}{$number_of_pages}'>{$number_of_pages}</a></span>";
        }

        echo '</div>';

    }
}


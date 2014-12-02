<?php
class Pagination {
    private $number_of_items;
    private $items_on_page;
    private $current_page;
    private $link;

    function __construct($all,$lim,$current) {
        $this->number_of_items = $all;
        $this->items_on_page = $lim;
        $this->current_page = $current;

        $this->link = "http://localhost/myFirstSite/content/page/";
    }

    function createPagination() {
        $number_of_pages = ceil($this->number_of_items/$this->items_on_page);
        $prev_next = 3;

        $start = max(1, $this->current_page - $prev_next);
        $end = min($number_of_pages, $this->current_page + $prev_next);

        if($start > 1) {
            echo "<span><a href='{$this->link}1'>1</a></span>";
        }

        if($this->current_page - 2 > $prev_next) {
            echo "<span>...</span>";
        }

        for($i = $start; $i <= $end; $i++) {
            if($i == $this->current_page) {
                echo '<span>'.$this->current_page.'</span>';
            }
            else {
                echo "<span><a href='{$this->link}{$i}'>{$i}</a></span>";
            }
        }

        if($number_of_pages - $this->current_page - 1 > $prev_next) {
            echo "<span>...</span>";
        }

        if($end < $number_of_pages) {
            echo "<span><a href='{$this->link}{$number_of_pages}'>{$number_of_pages}</a></span>";
        }

    }
}


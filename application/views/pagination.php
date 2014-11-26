<!--
/*
class Pagination
{
    public $curr_link;
    public $all;
    public $lim;
    public $link;
    public $prev;

    function __construct($all,$lim,$current) {
    $this->all = $all; // количество постов в категории (определяем количество постов в базе данных)
    $this->lim = $lim; // количество постов, размещаемых на одной странице
    $this->prev = 3; // количество отображаемых ссылок до и после номера текущей страницы
    $this->curr_link = $current; // номер текущей страницы (получаем из URL)

        $this->link = "http://localhost/myFirstSite/content/page/"; // часть а

    }
    // осуществляем проверку, чтобы выводимые первая и последняя страницы
    // не вышли за границы нумерации
    public function createPagination() {
    $first = $this->curr_link - $this->prev;
    if ($first < 1) $first = 1;
    $last = $this->curr_link + $this->prev;
    if ($last > ceil($this->all/$this->lim)) $last = ceil($this->all/$this->lim);

    // начало вывода нумерации
    // выводим первую страницу
    $y = 1;
    if ($first > 1) echo "<a href='{$this->link}{$y}'>1</a> ";
    // Если текущая страница далеко от 1-й (>10), то часть предыдущих страниц
    // скрываем троеточием
    // Если текущая страница имеет номер до 10, то выводим все номера
    // перед заданным диапазоном без скрытия
    $y = $first - 1;
    if ($first > 10) {
        echo "<a href='{$this->link}{$y}'>...</a> ";
    } else {
        for($i = 2;$i < $first;$i++){
            echo "<a href='{$this->link}{$i}'>$i</a> ";
        }
    }
    // отображаем заданный диапазон: текущая страница +-$prev
    for($i = $first;$i < $last + 1;$i++){
        // если выводится текущая страница, то ей назначается особый стиль css
        if($i == $this->curr_link) {

            echo "<span>{$i} </span>";

        } else {
            $alink = "<a href='{$this->link}{$i}";
            $alink .= "'>$i</a> ";
            echo $alink;
        }
    }
    $y = $last + 1;
    // часть страниц скрываем троеточием
    if ($last < ceil($this->all / $this->lim) && ceil($this->all / $this->lim) - $last > 1) echo "<a href='{$this->link}{$y}'>...</a> ";
    // выводим последнюю страницу
    $e = ceil($this->all / $this->lim);
    if ($last < ceil($this->all / $this->lim)) echo "<a href='{$this->link}{$e}'>$e</a>";
    }
}*/-->

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

/*        $to_first = $this->current_page - 2;
        $to_last = $number_of_pages - $this->current_page - 1;*/

        $start = max(1, $this->current_page - $prev_next);
        $end = min($number_of_pages, $this->current_page + $prev_next);

/*        if($this->current_page == 1) {
            echo $this->current_page;
        }
        else {
            echo "<span><a href='{$this->link}1'>1</a></span>";
        }*/


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

/*        if($this->current_page == $number_of_pages) {
            echo $this->current_page;
        }
        else {
            echo "<span><a href='{$this->link}{$number_of_pages}'>{$number_of_pages}</a></span>";
        }*/
    }
}


<?php
class View
{
    //public $template_view; // здесь можно указать общий вид по умолчанию.

    function generate($content_view,$header_view, $template_view, $data = null, $menu_view = 'menu_view.php') // Data['menu'] это имя меню Data['style'] это имя таблицы для
    {
        /*
        if(is_array($data)) {
            // преобразуем элементы массива в переменные
            extract($data);
        }
        */
        include 'application/views/'.$template_view;
    }
}
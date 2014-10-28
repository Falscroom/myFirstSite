<?php
class View
{
    //public $template_view; // здесь можно указать общий вид по умолчанию.

    function generate($content_view,$header_view, $template_view, $data = null,$menu_view = 'menu_view.php') // data['header']['css'] названия всех файлов css data['header']['js'] название всех файлов JS
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
<?php
class View
{
    //public $template_view; // здесь можно указать общий вид по умолчанию.

    function generate($content_view, $template_view, $files = array(), $data = null) // data['header']['css'] названия всех файлов css data['header']['js'] название всех файлов JS
    {
        if(!isset($files['menu']['file'])) {
            $files['menu']['file'] = 'menu_view.php';
        }
        if(!isset($files['header']['file'])) {
            $files['header']['file'] = 'template_header.php';
        }
        include 'application/views/'.$template_view;
    }
}
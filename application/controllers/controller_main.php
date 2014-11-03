<?php
class Controller_Main extends Controller
{
    function __construct() {
        $this->view = new View();
        $this->model = new Model_Main();
    }
    function action_index()
    {

        $files['header']['css'] = array();
        $files['header']['js'] = array();

        array_push($files['header']['css'],'main_menu_style.css');
        array_push($files['header']['css'],'main_style.css');
        array_push($files['header']['js'],'main_menu.js');

        $this->view->generate('main_view.php', 'template_view.php',$files,array('authorization' => $this->model->mainApproveLogin()));

    }
}
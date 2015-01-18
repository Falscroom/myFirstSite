<?php
class Controller_Main extends Controller
{
    function __construct() {
        $this->view = new View();
        $this->model = new Model_Main();
    }
    function action_index()
    {

        $files = $this->get_files_array(array('main_menu_style.css','main_style.css','main_menu.js','animation_three_level.js'));
        $data['authorization'] = $this->model->mainApproveLogin();
        $data['menu_items'] = $this->model->get_menu_items();
        $this->view->generate('main_view.php', 'template_view.php',$files,$data);

    }
}
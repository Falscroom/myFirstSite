<?php
class Controller_Main extends Controller
{
    function __construct() {
        $this->view = new View();
        $this->model = new Model_Main();
    }
    function action_index()
    {

        $this->view->generate('main_view.php','main_header.php', 'template_view.php',array('authorization' => $this->model->mainApproveLogin()));

    }
}
<?php
class Controller_Main extends Controller
{
    function __construct() {
        $this->view = new View();
        $this->model = new Model_Main();
    }
    function action_index()
    {
        if($this->model->mainApproveLogin()) {
            $this->view->generate('main_view.php','main_header.php', 'template_view.php');
        }
        else {
            header("Location:login");
        }

    }
}
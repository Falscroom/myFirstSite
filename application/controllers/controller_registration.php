<?php
class Controller_Registration extends Controller
{
    function __construct() {
        $this->view = new View();
        $this->model = new model_registration();
}
    function action_index()
    {
        $this->view->generate('registration_view.php','registration_header.php', 'template_view.php');
        if(isset($_POST['submit'])) {
            $this->model->addUser($_POST['login'],$_POST['password'],$_POST['contacts']);;
        }
    }
}
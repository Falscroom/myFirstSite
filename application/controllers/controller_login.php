<?php
class Controller_Login extends Controller
{
    function __construct() {
        $this->view = new View();
        $this->model = new model_login();
    }
    function action_index()
    {
        $errors = array();
        if(isset($_POST['submit'])) {
            $createIP = !isset($_POST['not_attach_ip']);

            if($this->model->approveUser($_POST['login'],$_POST['password'],$createIP)) {
                header("Location:main");
            }
            else {
                $errors['password_or_login'] = "has-error";
            }
        }
        $this->view->generate('login_view.php','login_header.php', 'template_view.php',$errors);
    }
}
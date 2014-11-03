<?php
class Controller_Login extends Controller
{
    function __construct() {
        $this->view = new View();
        $this->model = new model_login();
    }
    function action_index()
    {
        if(isset($_POST['submit'])) {
            $createIP = !isset($_POST['not_attach_ip']);

            if($this->model->approveUser($_POST['login'],$_POST['password'],$createIP)) {
                header("Location:main");
            }

        }

        $files['header']['css'] = array();
        $files['header']['js'] = array();

        array_push($files['header']['css'],'menu_without_animation.css');
        array_push($files['header']['css'],'login_style.css');
        array_push($files['header']['js'],'menu_without_animation.js');

        $this->view->generate('login_view.php', 'template_view.php',$files,$this->model->errors);
    }
}
<?php
class Controller_Registration extends Controller
{
    function __construct() {
        $this->view = new View();
        $this->model = new model_registration();
}
    function action_index()
    {
        if(isset($_POST['submit'])) {
            if($this->model->addUser($_POST['login'],$_POST['password'],$_POST['contacts'],$_POST['password2'])) {
                header("Location:login");
            }
        }

        $files['header']['css'] = array();
        $files['header']['js'] = array();

        array_push($files['header']['css'],'menu_without_animation.css');
        array_push($files['header']['css'],'register_style.css');
        array_push($files['header']['js'],'menu_without_animation.js');

        $this->view->generate('registration_view.php', 'template_view.php',$files,$this->model->errors);
    }
}
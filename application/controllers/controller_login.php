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

        $files = $this->get_files_array(array('menu_without_animation.css','login_style.css','menu_without_animation.js','animation_three_level.js'));
        $data['menu_items'] = $this->model->get_menu_items();
        $data['errors'] = $this->model->errors;
        $this->view->generate('login_view.php', 'template_view.php',$files,$data);
    }
}
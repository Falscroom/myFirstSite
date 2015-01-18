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

        $files = $this->get_files_array(array('menu_without_animation.css','register_style.css','menu_without_animation.js','animation_three_level.js'));
        $data['menu_items'] = $this->model->get_menu_items();
        $data['errors'] = $this->model->errors;
        $this->view->generate('registration_view.php', 'template_view.php',$files,$data);
    }
}
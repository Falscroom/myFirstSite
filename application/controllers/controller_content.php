<?php
class Controller_content extends Controller
{

    function __construct() {
        $this->view = new View();
        $this->model = new Model_Content();
    }

    function action_category($routes) {
        if($routes[0] == "page" && preg_match("/^[0-9]{1,6}$/",$routes[1]) && preg_match("/^[0-9]{1,6}$/",$routes[2])) {

            $files = $this->get_files_array(array('menu_without_animation.css','menu_without_animation.js','content_style.css','content_animation_description.js','animation_three_level.js'));
            $count = $this->model->GetCount($routes[1]);

            $data = array();
            $data['item'] = $this->model->GetContent($routes[2],$routes[1]);
            $data['menu_items'] = $this->model->get_menu_items();
            $data['number_of_pages'] = $count[0];
            $data['category'] = $routes[1];
            $data['current_page'] = $routes[2];
            $this->view->generate('content_view.php', 'template_view.php',$files,$data);

            //$this->model->delete_node(2,'mexican');
            //$this->model->create_node(3,'testoviyfrUkT','apple1');


        }
        else {
            Route::ErrorPage404();
        }
    }
}
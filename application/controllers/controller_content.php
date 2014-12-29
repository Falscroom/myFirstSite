<?php
class Controller_content extends Controller
{
    private $count = null;
    private $files = null;

    function __construct() {
        $this->view = new View();
        $this->model = new Model_Content();
    }
    function create_header() {
        $files['header']['css'] = array();
        $files['header']['js'] = array();

        array_push($files['header']['css'],'menu_without_animation.css');
        array_push($files['header']['js'],'menu_without_animation.js');
        array_push($files['header']['css'],'content_style.css');
        array_push($files['header']['js'],'content_animation_description.js');
        array_push($files['header']['js'],'animation_three_level.js');
        $this->files = $files;
    }
    function action_category($routes) {
        if($routes[0] == "page" && preg_match("/^[0-9]{1,6}$/",$routes[1]) && preg_match("/^[0-9]{1,6}$/",$routes[2])) {
            if(!$this->files) $this->create_header();

            if(!$this->count) $this->count = $this->model->GetCount($routes[1]);

            $data = array();
            $data['item'] = $this->model->GetContent($routes[2],$routes[1]);
            $data['menu_items'] = $this->model->get_menu_items();
            $data['number_of_pages'] = $this->count[0];
            $data['category'] = $routes[1];
            $data['current_page'] = $routes[2];
            $this->view->generate('content_view.php', 'template_view.php',$this->files,$data);

            //$this->model->delete_node(2,'mexican');
            //$this->model->create_node(3,'testoviyfrUkT','apple1');


        }
        else {
            Route::ErrorPage404();
        }
    }
}
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
        $this->files = $files;
    }

    function action_index()
    {
        // http://localhost/myFirstSite/category/view/1?page=3
        if(!$this->files) $this->create_header();

        if(!$this->count) $this->count = $this->model->GetCount();

        $data = array();
        $data['item'] = $this->model->GetContent(1);
        $data['current_page'] = 1;
        $data['limit'] = $this->count[0];

        $this->view->generate('content_view.php', 'template_view.php',$this->files,$data);

    }
/*    function action_page($routes) {
        if(!$this->files) {
            $this->create_header();
        }
        $number = $routes[0];

        $limit = $this->model->GetCount();
        $limit = $limit[0];

        $data = array();
        $data['item'] = $this->model->GetContent($number);
        $data['pag'] = array();
        array_push($data['pag'],$number);
        array_push($data['pag'],$limit);

        $this->view->generate('content_view.php', 'template_view.php',$this->files,$data);
    }*/

    function action_category($routes) {
        if($routes[0] == "page" && preg_match("/^[0-9]{1,6}$/",$routes[1]) && preg_match("/^[0-9]{1,6}$/",$routes[2])) {
            if(!$this->files) $this->create_header();

            if(!$this->count) $this->count = $this->model->GetCount();

            $data = array();
            $data['item'] = $this->model->GetContent($routes[1]);
            $data['current_page'] = $routes[1];
            $data['category_number'] = $routes[2];
            $data['limit'] = $this->count[0];

            $this->view->generate('content_view.php', 'template_view.php',$this->files,$data);

        }
        else {
            Route::ErrorPage404();
        }
    }
}
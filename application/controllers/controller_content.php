<?php
class Controller_content extends Controller
{

    function __construct() {
        $this->view = new View();
        $this->model = new Model_Content();
    }

    function action_category($routes) {
        if($routes[0] == "page" && preg_match("/^[0-9]{1,6}$/",$routes[1]) && preg_match("/^[0-9]{1,6}$/",$routes[2])) {

            $files = $this->get_files_array(array('content_menu_style.css','menu_without_animation.js','content_style.css','content_animation_description.js','animation_three_level.js','add_cart.js'));
            $files['menu']['file'] = 'content_menu_view.php';
            $count = $this->model->GetCount($routes[1]);

            $data = array();
            $data['item'] = $this->model->GetContent($routes[2],$routes[1]);
            $data['authorization'] = $this->model->mainApproveLogin();
            $data['menu_items'] = $this->model->get_menu_items();
            $data['number_of_pages'] = $count[0];
            $data['category'] = $routes[1];
            $data['current_page'] = $routes[2];
            $data['cart'] = $this->model->get_count();
            $this->view->generate('content_view.php', 'template_view.php',$files,$data);
            //$this->model->delete_node(2,'mexican');
            //$this->model->create_node(3,'testoviyfrUkT','apple1');


        }
        else {
            Route::ErrorPage404();
        }
    }
    function action_add($routes) {
        $model = new Model();
        $user_id = $_COOKIE['user_id'];



        $model->prepareQuery("SELECT COUNT(id) FROM `order` WHERE user_id=".$user_id."");
        $res  = $model->executeQuery_Row();
        if($res[0] > 0) {
            $model->prepareQuery("SELECT id FROM `order` WHERE user_id=".$user_id." LIMIT 1");
            $res  = $model->executeQuery_Row();


            $model->prepareQuery("INSERT INTO `order_item` (order_id,item_id) VALUES ('.$res[0].','.$routes[0].')");
            $model->executeQuery_Simple();
        }
        else {
            $model->prepareQuery("INSERT INTO `order`(`user_id`) VALUES ('.$user_id.')");
            $model->executeQuery_Simple();

            $model->prepareQuery("SELECT id FROM `order` WHERE user_id=".$user_id." LIMIT 1");
            $res  = $model->executeQuery_Row();


            $model->prepareQuery("INSERT INTO `order_item` (order_id,item_id) VALUES ('.$res[0].','.$routes[0].')");
            $model->executeQuery_Simple();


        }
    }
}
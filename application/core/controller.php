<?php
class Controller {

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }
    function get_files_array($array) {
       $files['header']['css'] = array();
       $files['header']['js'] = array();

       for($i = 0; $i < count($array); $i++) {
            if(preg_match("/.js$/",$array[$i])) {
                array_push($files['header']['js'],$array[$i]);
            }
           else {
               array_push($files['header']['css'],$array[$i]);
           }
        }
        return $files;
    }

    function action_index()
    {
    }
}
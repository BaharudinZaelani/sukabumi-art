<?php 

class App {
    // controller
    private $controller = "home";
    private $method = "index";
    private $params = [];

    function __construct()
    {
        session_start();
        $this->pretty($this->url());

        // views
    }

    function pretty($url){

        if ( isset($url[1]) ){
            $this->controller = ucfirst($url[1]);
            unset($url[1]);
        }

        include "../app/controller/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        if ( isset($url[2]) ){
            if( method_exists($this->controller, $url[2]) ){
                $this->method = $url[2];
                unset($url[2]);
            }
        }

        if( !empty($url) ){
            $this->params[] = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);

    }

    function url(){
        // pisahkan "/"
        $url = $_SERVER['REQUEST_URI'];
        $url = explode("/", $url);
        
        // unset index 0
        unset($url[0]);
        return $url;
    }
    
    public static function date (){
        date_default_timezone_set("Asia/Jakarta");
        return date('Y-m-d H:i:s');
    }
}
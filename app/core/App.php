<?php 

class App {
    // controller
    private $controller = "Home";
    private $method = "index";
    private $params = [];

    function __construct()
    {
        session_start();
        $this->pretty($this->url(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

    }

    function pretty($url){
        if ( $url[1] !== "" ){
            $this->controller = ucfirst($url[1]);
            unset($url[1]);
        }
        
        if( !file_exists("../app/controller/" . $this->controller . ".php") ){
            echo "404 Not Found";
            header("HTTP/1.1 404 Not Found");
            return false;
        }
        
        include "../app/controller/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        // var_dump(method_exists($this->controller::class, $this->method)); die;

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
    
    // Helper
    public static function date (){
        date_default_timezone_set("Asia/Jakarta");
        return date('Y-m-d H:i:s');
    }

    public static function redirect($uri, $message = ""){
        header("Location: " . $uri);
    }
    
}
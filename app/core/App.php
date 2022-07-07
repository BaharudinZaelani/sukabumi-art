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
        
        // clear alert notification
        if ( isset($_POST['clear']) ){
            App::clearAlert($_POST['name']);
        }

        // jika session rusak login ulang
        if ( isset($_SESSION['user']) AND $_SESSION['user']['password'] !== Middleware::$user['password'] ) {
            Middleware::logout();
            Middleware::loginArea();
        }

        $files = Database::getAll("image_file");
        // cek jika file tidak ada di folder uploads
        if ( !is_null($files) ) {
        	foreach ( $files as $row ) {
        		FileLogic::checkFile($row['filePath'], $row['id']);
        	}
        }
    }

    function pretty($url){
        if ( $url[1] !== "" ){
            $this->controller = ucfirst($url[1]);
            unset($url[1]);
        }
        
        if( !file_exists( $_SERVER['DOCUMENT_ROOT'] .  "/app/controller/" . $this->controller . ".php") ){
            App::redirect("/");
            return false;
        }

        include  $_SERVER['DOCUMENT_ROOT'] . "/app/controller/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        if ( isset($url[2]) ){
            $url[2] = str_replace("-", "", $url[2]);
            if( method_exists($this->controller, $url[2]) ){
                $this->method = $url[2];
                unset($url[2]);
            }
        }
        
        
        if( !empty($url) ){
            $this->params = array_values($url);
        }

        unset($url);
        
        call_user_func_array([$this->controller, $this->method], [$this->params]);
    
        
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

    public static function passwrodVerify($password, $dbPasswordHash, $hasToHash = true){
        if( $hasToHash ){
            return $password == $dbPasswordHash;
        }else {
            return password_verify($password, $dbPasswordHash);
        }
    }

    public static function clearAlert($param){
        $_SESSION['storage'][$param] = [];
        unset($_SESSION['storage'][$param]);
    }

    public static function byteConvert(string $byte) {
        // KB detector
        if ( $byte < 1000000 ) {
            if( $byte < 100000 ) {
                if ( $byte < 10000 ) {
                    if ( $byte < 10000 ) {
                        return "0," . substr($byte, 0, 1) . " KB";
                    }
                    return substr($byte, 0, 1) . " KB";
                }
                return substr($byte, 0, 2) . " KB";
            }
            return substr($byte, 0, 3) . " KB";
        }

        // MB detector 
        if( $byte > 1000000 ) {
            return substr($byte, 0, 1) . " MB";
        }
    }
}
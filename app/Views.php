<?php 

class Views {
    private static $title = "";
    private static $bodyContent = [];

    public static $dataSend = [];
    public static $componentsData = [];

    function __destruct(){
        if(file_exists("./views/layout.php")) {
            include "./views/layout.php";
        }else {
            echo "@error : layout.php not found !";
        }
    }

    // title controller
    public function setTitle($value){
        Views::$title = $value;
    }

    public static function getTitle(){
        return Views::$title;
    }

    // content Controller
    public function setContentBody($file = []){
        $resultPath = [];
        foreach( $file as $key => $row ){
            $resultPath[] = "./views/" . $row . ".php";
        }
        Views::$bodyContent = $resultPath;
    }

    public static function getComponents($fileName, $arr = []){
        Views::$componentsData = $arr;
        $path = "./views/components/" . $fileName . ".php";
        if( file_exists($path) ){
            include $path;
        }else {
            echo "@error : $path <b>File not found</b>";
            die;
        }
    }

    public static function sendData($data = []){
        $resultPath = [];
        foreach( $data as $key => $row ){
            $resultPath[$key] = $row;
        }
        Views::$dataSend = $resultPath;
    }

    public static function getContentBody(){
        return Views::$bodyContent;
    }

    // helper
    public static function assets($path){
        return URI . "assets/" . $path;
    }
}
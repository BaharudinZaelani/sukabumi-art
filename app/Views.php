<?php 

class Views {
    // Web Stitle
    private static $title = "";
    // Body Content
    private static $bodyContent = [];
    // data send
    public static $dataSend = [];

    function __destruct(){
        include "./views/layout.php";
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
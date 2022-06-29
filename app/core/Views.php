<?php 

class Views {
    
    public function setView($fileName){
        $path = "../assets/components/" . $fileName . ".php";
        include $path;
    }

}
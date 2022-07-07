<?php 

class About extends Views{


    function __construct(){
        new Database();
        Views::setTitle("< Back to Home");

        // first Config Front-End
        Views::setContentBody([
            "components/header",
            "contents/about/index",
        ]);
    }

    function index(){
        return;
        
    }

}
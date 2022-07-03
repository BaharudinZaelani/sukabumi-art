<?php 

class Login extends Views{

    function index($res = []){
        new Database();
        new Middleware();
        
        if ( Middleware::$login ){
            App::redirect("/dashboard");
        }

        // views
        Views::setTitle("SK-ART - Login");
        
        Views::setContentBody([
            "components/header",
            "contents/login/index",
        ]);

    }

}
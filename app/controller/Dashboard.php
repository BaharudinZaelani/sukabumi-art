<?php 


class Dashboard extends Views {
    
    function __construct(){
        new Database();
        new Middleware();
        
        if ( !Middleware::$login ) {
            header("HTTP/1.1 404 Not Found");
            echo "404 Not Found";
            die;
        }

        Views::setTitle("Dashboard - " . $_SESSION['user']['username']);
    }

    function index($value = []){
        $user = Database::getAll("user");
        
        Views::sendData([
            "account" => count($user)
        ]);
        Views::setContentBody([
            "content" => "contents/dashboard/index"
        ]);
    }

    function account(){
        $dataUser = Database::get("user", "=", "id", Middleware::$user['id']);
        Views::sendData([
            "user" => $dataUser
        ]);
        Views::setContentBody([
            "content" => "contents/dashboard/account"
        ]);
    }

    function accountlist(){
        $user = Database::getAll("user");
        Views::sendData([
            "user" => $user
        ]);
        Views::setContentBody([
            "content" => "contents/dashboard/account-list"
        ]);
    }

    // function 
    function logout(){
        $logout = Middleware::logout();
        App::redirect("/login");
    }

}
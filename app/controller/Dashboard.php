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

    function groups( $value = [] ) {
        $dataGroup = Database::getAll("group_file", "=" , "user_id", Middleware::$user['id']);
        // var_dump($dataGroup);die;
        $dataUser = Database::get("user", "=", "id", Middleware::$user['id']);
        Views::sendData([
            "user" => $dataUser,
            "groups" => $dataGroup
        ]);
        // delete group
        if ( isset($value[0]) AND $value[0] == "delete" AND isset($value[1]) ) {
            // cari data jika ketemu
            foreach ( $dataGroup as $row ) {
                if ( $row['id'] == "$value[1]" ) {
                    $msg = Database::destroy("group_file", $value[1]);
                    $_SESSION['storage']['delete_group'] = $msg;
                    App::redirect("/dashboard/groups");
                }
            }
            App::redirect("/dashboard/groups");
        }



        Views::setContentBody(["contents/dashboard/groups"]);
    }

    function files($values = []) {
        $dataGroup = Database::getAll("group_file", "=", "user_id", Middleware::$user['id']); 
        $dataFiles = Database::getAll("image_file", "=", "user_id", Middleware::$user['id']);
        if( isset($values[0]) ){
            $idFiles = $values[0];
            $groupId = "";
            $result = [
                "file" => "",
                "group" => ""
            ];
            // file search
            foreach( $dataFiles as $row ){
                if( $row['id'] == $idFiles ){ 
                    $result['file'] = $row;
                    $groupId = $row['group_id'];
                    break;
                }
            }
            // group search
            foreach ( $dataGroup as $row ) {
                if( $row['id'] == $groupId) {
                    $result['group'] = $row;
                    break;
                }
            }

            Views::sendData($result);
            Views::setContentBody(["contents/dashboard/detail_file"]);
            return;
        }
        
        Views::sendData([
            "group" => $dataGroup,
            "files" => $dataFiles
        ]);
        Views::setContentBody(["contents/dashboard/files"]);
    }

    // function 
    function logout(){
        $logout = Middleware::logout();
        App::redirect("/login");
    }

}
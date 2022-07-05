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
        $dataUser = Database::get("user", "=", "id", Middleware::$user['id']);
        $dataFiles = Database::getAll("image_file", "=", "user_id", Middleware::$user['id']);
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
                    if ( $msg["status"] == "error" ) {
                        $_SESSION['storage']['delete_group'] = [
                            "status" => "error",
                            "message" => "Gagal dihapus ! Kosongkan Group terlebih dahulu !"
                        ];
                        App::redirect("/dashboard/groups");
                        return;
                    }

                    $_SESSION['storage']['delete_group'] = $msg;
                    App::redirect("/dashboard/groups");
                }
            }
            App::redirect("/dashboard/groups");
        }
        // Edit Group
        else if ( isset($value[0]) AND $value[0] == "edit" AND isset($value[1]) ) {
            $groupId = "";
            $group = [];
            $file = [];
            
            // cari group
            foreach( $dataGroup as $row ) {
                if ( $row['id'] == "$value[1]" ) {
                    $groupId = $row['id'];
                    $group = $row;
                    break;
                }
            }

            // cari file
            foreach ( $dataFiles as $row ) {
                if ( $row['group_id'] == $groupId ) {
                    $file[] = $row;
                }
            }
            Views::sendData([
                "group" => $group,
                "file" => $file
            ]);
            Views::setContentBody(["contents/dashboard/groups_edit"]);
            return;
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

            
            // jika file diownload
            if ( isset($values[1]) AND $values[1] == "download") {
                $filepath = $result['file']['filePath'];
                $extension = $result['file']['extension'];
                header('Content-Description: File Transfer');
                header('Content-Type: image/' . $extension);
                header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filepath));
                flush(); // Flush system output buffer
                readfile($filepath);
                App::redirect("/dashboard/files/" . $result['file']['id']);
                return;
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
<?php 


class LoginLogic {
    
    public static function login($username, $password){
        $userCek = Database::get("user", "=", "username", $username);
        $group = Database::getAll("group_file", "=", "user_id", $userCek['id']);
        $file = Database::getAll("image_file", "=", "user_id", $userCek['id']);
        if ( $file == false ) {
            $file = 0;
        }else {
            $file = count($file);
        }

        if( $userCek == NULL OR !password_verify($password, $userCek['password']) ){
            return [
                "status" => "error",
                "message" => "Username or Password Not found in our database !"
            ];
        }

        $_SESSION['user'] = [
            "id" => intval($userCek['id']),
            "username" => $userCek['username'],
            "password" => $userCek['password'],
            "role" => $userCek['role'],
            "login_time" => App::date(),
            "group_count" => count($group),
            "file_count" => $file
        ];
        App::redirect("/dashboard");
    }

}
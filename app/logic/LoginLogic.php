<?php 


class LoginLogic {
    
    public static function login($username, $password){
        $userCek = Database::get("user", "=", "username", $username);
        if( $userCek == NULL OR !password_verify($password, $userCek['password']) ){
            return [
                "status" => "error",
                "message" => "Username or Password Not found in our database !"
            ];
        }

        $_SESSION['user'] = [
            "username" => $userCek['username'],
            "password" => $userCek['password'],
            "login_time" => App::date(),
        ];
        App::redirect("/dashboard");
    }

}
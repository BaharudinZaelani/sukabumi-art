<?php 


class AccountLogic {

    public static function updateProfile( $data = [], $password, $id){
        // if password match
        if( App::passwrodVerify($password, Middleware::$user['password'], false) ){
            // cek if user exists
            $user = Database::get("user", "=", "id", $id);

            // logic update
            if ( App::passwrodVerify($user['password'], Middleware::$user['password']) ) {
                $edit = Database::update("user", $data, $id, "Profile berhasil diubah !");

                App::redirect("/dashboard/account");
                return $edit;
            }else {
                return [
                    "status" => "error",
                    "message" => "dumb hacker ! fuck you !"
                ];
            }
        }

        $_SESSION['alert_update_profile'] = [
            "status" => "error",
            "message" => "Password salah !"
        ];

        return false;
         
    }

}
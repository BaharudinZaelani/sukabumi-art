<?php 

class Middleware {

    public static $login = false;
    public static $user = [];

    /* Jika user sudah login arahkan ke dashboard (current page : Login)
     * Jika user belum login arahkan ke login (current page : Dashboard)
     */

    function __construct(){
        if ( isset($_SESSION['user']) ){
            $getUser = Database::get("user", "=", "username", $_SESSION['user']['username']);
            if ( !is_null($getUser) ) {
                if( $_SESSION['user']['password'] == $getUser['password'] ){
                    Middleware::$login = true;
                    Middleware::$user = $_SESSION['user'];
                }
            }
        }
    }

    public static function loginArea(){
        // if ( isset($_SESSION['user']) ) {
        //     // cek user apakah benar-benar dia adalah user ?
        //     $getUser = Database::get("user", "=", "username", $_SESSION['user']['username']);
        //     $passwordVerif = false;
        //     if ( !is_null($getUser) ) {
        //         $passwordVerif = $_SESSION['user']['password'] == $getUser['password'];
        //     }

            
        // }

        // jika tidak sesuai
        if( !Middleware::$login ){
            return [
                "status" => "Not Match",
                "cond" => false,
                "message" => "User tidak ditemukan ! Harap login kembali !"
            ];
        }

        // jika sesuai
        return [
            "status" => "Found",
            "cond" => true,
            "message" => "User ditemukan ! Silahkan nikmati aplikasinya tuan :)"
        ];
    }

    public static function logout(){
        $_SESSION['user'] = [];
        unset($_SESSION['user']);

        return [
            "status" => "success", 
            "message" => "Berhasil Logout dari Aplikasi !"
        ];
    }

    
    public static function checkLogin(){
        if( isset($_SESSION['user']) ){
            // if ( $_SESSION['user']['password'] ==  ){

            // }
        }
    }
}
<?php 

class Register extends Views {
    function index($value = []){
        new Database();

        $addUser = Database::add("user", [
            "id" => NULL,
            "username" => "zawadmin",
            "password" => password_hash("admin123", PASSWORD_DEFAULT),
            "email" => "zaw@sdja.com",
            "role" => "admin",
            "created_at" => App::date(),
            "updated_at" => NULL
        ], "Data berhasil ditambahkan ! :3");

        echo $addUser['message'];
    }
}
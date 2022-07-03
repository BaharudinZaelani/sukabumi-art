<?php 

class Home extends Views{

    function index($value = []){
        // Connect to Database
        new Database();

        // submit data to Front End
        // Views::sendData([
        //     "books" => $books,
        //     "user" => $user
        // ]);

        // first Config Front-End
        Views::setTitle("SK-ART");
        Views::setContentBody([
            "components/header",
            "contents/home/index",
        ]);
    }
}
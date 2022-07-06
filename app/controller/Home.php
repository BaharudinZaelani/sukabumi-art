<?php 

class Home extends Views{

    private $groups = [];
    private $files = [];
    private $users = [];

    function __construct(){
        new Database();
        // get data
        $this->groups = Database::getAll("group_file");
        $this->files = Database::getAll("image_file");
        $this->users = Database::getAll("user");

        Views::setTitle("SK-ART");
        // first Config Front-End
        Views::setContentBody([
            "components/header",
            "contents/home/index",
        ]);

    }

    function index(){

        Views::sendData([
            "groups" => $this->groups,
            "files" => $this->files,
            "users" => $this->users
        ]);
        
    }

}
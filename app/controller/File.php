<?php 


class File extends Views {

    function __construct(){
        new Database();

        Views::setTitle("< Back to Home");
        
    }

    function index( $val = [] ) {
        // var_dump($val);die;
        if ( !empty($val[0]) ) {
            $valRes = explode("_", $val[0]);
            $filePath = "storage/uploads/" . $valRes[0];
            $dataFile = Database::get("image_file", "LIKE", "filePath", "%$filePath%");
            $user = Database::get("user", "=", "id", $dataFile['user_id']);

            $group = Database::get("group_file", "=", "id", $dataFile['group_id']);

            if ( isset($val[1]) AND $val[1] == "download" ) {
                FileLogic::download($dataFile['filePath'], $dataFile['extension']);
                App::redirect("/file" . "/" . $val[0]);
            } 

            Views::sendData([
                "file" => $dataFile,
                "group" => $group,
                "user" => $user
            ]);

            // first Config Front-End
            Views::setContentBody([
                "components/header",
                "contents/home/show"
            ]);
            return;
        }
        header("HTTP/1.1 404 Not Found");
        echo "File Kosong bang :( <br>";
        echo "<a href='/'>< Kembali kehalaman utama</a>"; 
    }
}
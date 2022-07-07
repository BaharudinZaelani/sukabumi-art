<?php 


class File extends Views {

    function __construct(){
        new Database();

        Views::setTitle("< Back to Home");
        
    }

    function index( $val = [] ) {
        if ( !empty($val[0]) ) {
            $valRes = explode("_", $val[0]);
            $filePath = "storage/uploads/" . $valRes[0];
            $dataFile = Database::get("image_file", "LIKE", "filePath", "%$filePath%");
            $user = Database::get("user", "=", "id", $dataFile['user_id']);

            $groups = Database::getAll("group_file");
            $group = [];

            $newItem = [];
            $newItemExists = false;

            $minItem = [];
            $minItemExist = false;


            if ( isset($val[1]) AND $val[1] == "download" ) {
                FileLogic::download($dataFile['filePath'], $dataFile['extension']);
                App::redirect("/file" . "/" . $val[0]);
            }else {
                if ( !empty($val[1]) ) {
                    $currentItem = $dataFile['id'];
                    $nextItem = 0;
                    $prevItem = -1;
                    $allFile = Database::getAll("image_file", "=", "group_id", $val[1]);

                    // check group
                    foreach ( $groups as $row ) {
                        if ( $row['id'] == $allFile[0]['group_id'] ) {
                            $group = $row;
                            break;
                        }
                    }
                    
                    if ( $allFile == false ) {
                        App::redirect("/");
                        return;
                    }

                    foreach ( $allFile as $key => $row ) {
                        $nextItem += 1;
                        $prevItem = $nextItem - 2;
                        if ( $currentItem == $row['id'] ) {
                            break;
                        }
                    }
                    
                    // jika next item tidak ada
                    if ( !empty($allFile[$nextItem]) ) {
                        $newItem = $allFile[$nextItem];
                        $newItemExists = true;
                    }

                    // jika prev item tidak ada
                    if ( !empty($allFile[$prevItem]) ) {
                        $minItem = $allFile[$prevItem];
                        $minItemExist = true;
                    }
                    
                }else {
                    App::redirect("/");
                }
            }
            
            Views::sendData([
                "file" => $dataFile,
                "group" => $group,
                "user" => $user,
                "nextItem" => [
                    "item" => $newItem,
                    "exists" => $newItemExists
                ],
                "prevItem" => [
                    "item" => $minItem,
                    "exists" => $minItemExist
                ]
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
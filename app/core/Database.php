<?php 

class Database {
    private $host = HOST;
    private $user = USER;
    private $pass = PASSWORD;
    private $db_name = DB_NAME;
    private static $conn;


    function __construct(){
        try {
            Database::$conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db_name);
        }catch( Exception $e ){
            die("Unnable to connect DB, Error message : " . $e);
        }
    }

    // Get query
    static function query($query){
        return mysqli_query(Database::$conn, $query);
    }

    static function getAll($table = "", $operator = "", $row = "", $value = ""){
        if( $row !== "" ){
            $query = "SELECT * FROM `$table` WHERE `$row` $operator $row";
        }else {
            $query = "SELECT * FROM `$table`";
        }
        $result = Database::query($query);
        while ( $row = mysqli_fetch_assoc($result) ) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    public static function get($table = "", $operator = "", $row = "", $value = ""){
        if( $row !== "" ){
            $query = "SELECT * FROM `$table` WHERE `$row` $operator '$value'";
        }else {
            $query = "SELECT * FROM `$table`";
        }
        // var_dump($query);die;
        return mysqli_fetch_assoc(Database::query($query));
    }

    // Post query
    public static function add($table = "", $data = [], $message = ""){
        $stringQuery = "INSERT INTO `$table` ";

        // create a syntax db keys
        $stringRow = "";

        $stringRow .= "(";
        foreach ( $data as $key => $row ){
            $stringRow .= " `$key`,";
        }
        $stringRow .= ") VALUES (";
        $stringRow = str_replace(",)", ")", $stringRow);


        // create a syntax db values
        $stringValue = "";
        foreach ( $data as $key => $row ) {
            if( is_null($row) ){       
                $stringValue .= " NULL,";
            }else {
                $stringValue .= " '$row',";
            }
        }
        $stringValue .= ");";
        $stringValue = str_replace(",);", ");", $stringValue);
        
        // result
        $queryResult = $stringQuery . $stringRow . $stringValue;

        // execute
        Database::query($queryResult);

        return [
            "Action" => "Success",
            "message" => $message
        ];
    }

    public static function update($table, $data = [], $id, $message = ""){
        // UPDATE `user` SET `email` = 'bahar32harz@gmail.com' WHERE `user`.`id` = 7;
        // UPDATE `user` SET `email` = 'bahar32har@gmail.com', `created_at` = '2022-07-03' WHERE `user`.`id` = 7;
        $strQuery = "UPDATE `$table` SET ";
        foreach ( $data as $key => $row ){
            $strQuery .= "`$key` = '$row' ,";
        }
        // auto updated
        $strQuery .= " `updated_at` = '" . App::date() . "'";
        $strQuery .= " WHERE `$table`.`id` = $id";
        // $strQuery = str_replace(", WHERE", " WHERE", $strQuery);


        Database::query($strQuery);

        return [
            "status" => "success",
            "message" => $message
        ];
    }

    public static function destroy($table, $id) {
        //  DELETE FROM `user` WHERE `user`.`id` = 8
        $query = "DELETE FROM `$table` WHERE `$table`.`id` = $id";
        Database::query($query);

        return [
            "status" => "success",
            "message" => "Data berhasil dihapus !"
        ];
    }
    
}
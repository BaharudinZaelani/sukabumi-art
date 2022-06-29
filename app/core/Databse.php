<?php 

class Database {
    private $host = HOST;
    private $user = USER;
    private $pass = PASSWORD;
    private $db_name = DB_NAME;
    private $conn;

    function __construct(){
        try {
            $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db_name);
        }catch( Exception $e ){
            die("Unable to connect DB, Error message : " . $e);
        }
    }

    private function query($query){
        return mysqli_query($this->conn, $query);
    }

    public function getAll($table = "", $operator = "=", $row){
        $query = "SELECT * FROM `$table` WHERE `$row` $operator $row";
        $result = $this->query($query);
        while ( $row = mysqli_fetch_object($result) ) {
            $hasil[] = $row;
        }
        return $row;
    }

    public function get($table = "", $operator = "=", $row){
        $query = "SELECT * FROM `$table` WHERE `$row` $operator $row";
        return mysqli_fetch_object($this->query($query));
    }

}
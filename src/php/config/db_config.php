<?php 

class dbHandler{

    protected static $db_host = "localhost:8889";
    protected static $db_name = "crud-dev";
    protected static $db_user = "omer";
    protected static $password_file_path = "../../../db/password.txt";

    public static function getHandler(){

        $dbHost = self::$db_host;
        $dbName = self::$db_name;
        $db_pass = trim(file_get_contents(self::$password_file_path));
        $pdo = new PDO("mysql:host=$dbHost};dbname=$dbName", self::$db_user, $db_pass);
        return $pdo;
    }
}



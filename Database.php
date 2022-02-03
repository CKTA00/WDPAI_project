<?php

require_once 'config.php';

class Database
{
    private $username;
    private $password;
    private $host;
    private $database;

    private static $instance;

    private function __construct()
    {
        $this->username = USERNAME;
        $this->password = PASSWORD;
        $this->host = HOST;
        $this->database = DATABASE;
        static::$instance = $this;
    }

    public static function getInstance(): Database
    {
        if(!isset(static::$instance))
            static::$instance = new Database();

        return static::$instance;
    }

    public function connect(){
        try{
            $conn = new PDO(
                "pgsql:host=$this->host;port=5432;dbname=$this->database",
                $this->username,
                $this->password,
                ["sslmode" => "prefer"]
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e){
            die("Connection to Database failed: ".$e->getMessage());
        }
    }
}
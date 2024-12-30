<?php

// Usage
// 
// $connection = Database::getInstance()->getConnection();
class Database
{
    private static $instance;
    private \mysqli  $connection; 

    private function __construct()
    {
        $this->connection = mysqli_connect("localhost", "root", "", "trainerfinder");
    }

    public static function getInstance(): Database
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getConnection(): \mysqli
    {
        return $this->connection;
    }
}

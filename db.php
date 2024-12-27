<?php

// Usage
// $db = Database::getInstance();
// $connection = $db->getConnection();
class Database
{
    private static $instance;
    private mysqli $connection;

    private function __construct()
    {
        $this->connection = mysqli_connect("localhost", "root", "", "TrainerFinder");
    }

    public static function getInstance(): Database
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }
}

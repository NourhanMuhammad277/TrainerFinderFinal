<?php

// Usage
// $db = Database::getInstance();
// $connection = $db->getConnection();
class Database
{
    private static $instance;
    private $connection;

    private function __construct()
    {
        $this->connection = mysqli_connect("localhost", "root", "", "TrainerFinder");
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

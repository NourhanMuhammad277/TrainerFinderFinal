<?php

use Database;

class AccpetedTrainerModel implements Model
{
    public static function getAll(): array
    {    $i=0;
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $query = "SELECT * FROM accepted_trainers";
        $result = $conn->query($query , MYSQLI_USE_RESULT);
        $resultArray = [];
       while ($row = $result->fetch_assoc()) {
        $resultArray = array_merge($resultArray, $row);
       }
        return $resultArray;
    }

    public static function getById($id): array
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $query = "SELECT * FROM accepted_trainers WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    //TODO
    public static function create($data): bool
    {
        return false;
    }

    public static function update($id, $data): bool
    {
        return false;
    }
    public static function delete($id): bool
    {
        return false;
    }
}

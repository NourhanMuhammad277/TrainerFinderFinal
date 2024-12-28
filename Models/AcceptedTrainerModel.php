<?php
require_once(__DIR__ . "/Model.php");
require_once __DIR__ . "/../db.php";
class AcceptedTrainerModel implements Model
{
    public static function getAll(): array|null
    {
        $trainers = [];
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM accepted_trainers";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $trainers[] = $row;
            }
            return $trainers;
        }
        return null;
    }

    public static function getById($id): array
    {

        $conn = Database::getInstance()->getConnection();
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
        $conn = Database::getInstance()->getConnection();
        return false;
    }

    public static function update($id, $data): bool
    {
        $conn = Database::getInstance()->getConnection();
        return false;
    }
    public static function delete($id): bool
    {
        $conn = Database::getInstance()->getConnection();
        return false;
    }
}

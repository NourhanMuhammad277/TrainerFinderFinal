<?php
class AdminClass {

    public static function getUsers($conn) {
        $query = "SELECT * FROM users";
        return self::executeSelectQuery($conn, $query);
    }
    public static function getApplications($conn) {
        $query = "SELECT * FROM applications";
        return self::executeSelectQuery($conn, $query);
    }
    public static function getTrainers($conn) {
        $query = "SELECT * FROM trainers";
        return self::executeSelectQuery($conn, $query);
    }

    public static function acceptApplication($conn, $applicationId) {
        $query = "UPDATE applications SET status = 'Accepted' WHERE id = ?";
        return self::executePreparedQuery($conn, $query, [$applicationId]);
    }

    public static function rejectApplication($conn, $applicationId) {
        $query = "UPDATE applications SET status = 'Rejected' WHERE id = ?";
        return self::executePreparedQuery($conn, $query, [$applicationId]);
    }

    public static function deleteUser($conn, $userId) {
        $query = "DELETE FROM users WHERE id = ?";
        return self::executePreparedQuery($conn, $query, [$userId]);
    }

    public static function deleteTrainer($conn, $trainerId) {
        $query = "DELETE FROM trainers WHERE id = ?";
        return self::executePreparedQuery($conn, $query, [$trainerId]);
    }

    public static function executeSelectQuery($conn, $query) {
        global $conn; // Use the global $conn variable
        $result = mysqli_query($conn, $query);

        if ($result) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        return false;
    }

    private static function executePreparedQuery($conn, $query, $params) {
        $stmt = $conn->prepare($query);
        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);
        return $stmt->execute();
    }
}
?>

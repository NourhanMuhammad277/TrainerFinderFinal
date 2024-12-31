<?php
include_once '../db.php';

class ProfileModel {
    private $connection;

    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getUserData($userId) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Update user data in the database
    public function updateUserData($userId, $email, $username) {
        $stmt = $this->connection->prepare("UPDATE users SET email = ?, username = ? WHERE id = ?");
        $stmt->bind_param("ssi", $email, $username, $userId);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    // Insert trainer application into the database
    public function insertTrainerApplication($userId, $location, $sport, $dayTime, $certificate,$username,$email) {
    $state = 'pending';                     // Default state
    $sql = "INSERT INTO trainer_applications (user_id, username, email, location, sport, day_time, certificate, state) 
                VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')";
        $stmt = $this->connection->prepare($sql);

    if (!$stmt) {
        file_put_contents('log.txt', "DB Prepare Error: " . $this->connection->error . "\n", FILE_APPEND);
        return false;
    }
    $stmt->bind_param("issssss", $userId, $username, $email, $location, $sport, $dayTime, $certificate);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        return true;
    } else {
        file_put_contents('log.txt', "DB Execution Error: " . $stmt->error . "\n", FILE_APPEND);
        return false;
    }
}
public function TrainerChecking($user_id){
    $query = "SELECT * FROM accepted_trainers WHERE user_id = ?";
    $stmt = $this->connection->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
    }
    public function ApplyChecking($user_id){
        $query = "SELECT * FROM trainer_applications WHERE user_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
        }
}

?>

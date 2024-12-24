<?php

use Database;

class AdminModel
{

    // Get all applications
    public static function getApplications()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $query = "SELECT * FROM applications"; // Replace with actual table and columns
        $result = mysqli_query($conn, $query);

        if ($result) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        return [];
    }

    // Get all users
    public static function getUsers()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $query = "SELECT * FROM users"; // Replace with actual table and columns
        $result = mysqli_query($conn, $query);

        if ($result) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        return [];
    }

    // Get all trainers
    public static function getTrainers()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $query = "SELECT * FROM trainers"; // Replace with actual table and columns
        $result = mysqli_query($conn, $query);

        if ($result) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        return [];
    }

    // Accept a trainer application
    public static function acceptApplication($applicationId)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $query = "UPDATE applications SET status = 'Accepted' WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $applicationId);

        if (mysqli_stmt_execute($stmt)) {
            return true;
        }
        return false;
    }

    // Reject a trainer application
    public static function rejectApplication($applicationId)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $query = "UPDATE applications SET status = 'Rejected' WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $applicationId);

        if (mysqli_stmt_execute($stmt)) {
            return true;
        }
        return false;
    }

    // Delete a user
    public static function deleteUser($userId)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $query = "DELETE FROM users WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $userId);

        if (mysqli_stmt_execute($stmt)) {
            return true;
        }
        return false;
    }

    // Update a user
    public static function updateUser(
        $userId,
        $email,
        $username,
        $password
    ) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $query =
            "UPDATE users SET email = ?, username = ?, password = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param(
            $stmt,
            "sssi",
            $email,
            $username,
            $password,
            $userId
        );

        if (mysqli_stmt_execute($stmt)) {
            return true;
        }
        return false;
    }

    // Edit a trainer
    public static function updateTrainer(
        $trainerId,
        $username,
        $email,
        $location,
        $sport,
        $timings
    ) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $query =
            "UPDATE trainers SET username = ?, email = ?, location = ?, sport = ?, timings = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param(
            $stmt,
            "sssssi",
            $username,
            $email,
            $location,
            $sport,
            $timings,
            $trainerId
        );

        if (mysqli_stmt_execute($stmt)) {
            return true;
        }
        return false;
    }

    // Delete a trainer
    public static function deleteTrainer($trainerId)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $query = "DELETE FROM trainers WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $trainerId);

        if (mysqli_stmt_execute($stmt)) {
            return true;
        }
        return false;
    }

    // Add a new trainer
    public static function addTrainer(

        $username,
        $email,
        $location,
        $sport,
        $timings
    ) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $query =
            "INSERT INTO trainers (username, email, location, sport, timings) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param(
            $stmt,
            "sssss",
            $username,
            $email,
            $location,
            $sport,
            $timings
        );

        if (mysqli_stmt_execute($stmt)) {
            return true;
        }
        return false;
    }
    public function getUserById($id)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $query = 'SELECT * FROM users WHERE id = ?';
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if ($result) {
            return $result;
        }
        return false;
    }
}

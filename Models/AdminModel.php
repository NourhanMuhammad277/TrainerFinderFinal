<?php

use Database;

class AdminClass
{
    //USING CRUD FUNCTIONS 

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
    public static function getUsers($conn) {
        $query = "SELECT id, username, email FROM users";
        $result = $conn->query($query);
        $users = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }

    public static function updateUser($conn, $id, $username, $email) {
        $query = "UPDATE users SET username = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssi', $username, $email, $id);
        return $stmt->execute();
    }

    public static function deleteUser($conn, $id) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
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

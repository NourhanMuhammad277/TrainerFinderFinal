<?php
class AdminClass {

    // Get all applications
    public static function getApplications($conn) {
        $query = "SELECT * FROM applications"; // Replace with actual table and columns
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        return [];
    }

    // Get all users
    public static function getUsers($conn) {
        $query = "SELECT * FROM users"; // Replace with actual table and columns
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        return [];
    }

    // Get all trainers
    public static function getTrainers($conn) {
        $query = "SELECT * FROM trainers"; // Replace with actual table and columns
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        return [];
    }

    // Accept a trainer application
    public static function acceptApplication($conn, $applicationId) {
        $query = "UPDATE applications SET status = 'Accepted' WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $applicationId);
        
        if (mysqli_stmt_execute($stmt)) {
            return true;
        }
        return false;
    }

    // Reject a trainer application
    public static function rejectApplication($conn, $applicationId) {
        $query = "UPDATE applications SET status = 'Rejected' WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $applicationId);
        
        if (mysqli_stmt_execute($stmt)) {
            return true;
        }
        return false;
    }

    // Delete a user
    public static function deleteUser($conn, $userId) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        
        if (mysqli_stmt_execute($stmt)) {
            return true;
        }
        return false;
    }

    // Update a user
    public static function updateUser($conn, $userId, $email, $username, $password) {
        $query = "UPDATE users SET email = ?, username = ?, password = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sssi', $email, $username, $password, $userId);
        
        if (mysqli_stmt_execute($stmt)) {
            return true;
        }
        return false;
    }

    // Edit a trainer
    public static function updateTrainer($conn, $trainerId, $username, $email, $location, $sport, $timings) {
        $query = "UPDATE trainers SET username = ?, email = ?, location = ?, sport = ?, timings = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sssssi', $username, $email, $location, $sport, $timings, $trainerId);
        
        if (mysqli_stmt_execute($stmt)) {
            return true;
        }
        return false;
    }

    // Delete a trainer
    public static function deleteTrainer($conn, $trainerId) {
        $query = "DELETE FROM trainers WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $trainerId);
        
        if (mysqli_stmt_execute($stmt)) {
            return true;
        }
        return false;
    }

    // Add a new trainer
    public static function addTrainer($conn, $username, $email, $location, $sport, $timings) {
        $query = "INSERT INTO trainers (username, email, location, sport, timings) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sssss', $username, $email, $location, $sport, $timings);
        
        if (mysqli_stmt_execute($stmt)) {
            return true;
        }
        return false;
    }
}
?>

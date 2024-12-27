<?php

include_once '../Models/AdminModel.php'; // Include the model
include_once '../db.php'; 

class AdminController {
    public static function handleRequest() {
        $page = $_GET['page'] ?? ''; // Get the page parameter
        switch ($page) {
            case 'dashboard':
                self::showDashboard();
                break;
            case 'users':
                self::viewUsers();
                break;
            case 'applications':
                self::manageApplications();
                break;
            case 'trainers':
                self::viewTrainers();
                break;
            case 'addTrainer':
                self::addTrainer();
                break;
            case 'updateTrainer':
                self::updateTrainer();
                break;
            case 'deleteTrainer':
                self::deleteTrainer();
                break;
            default:
                self::showDashboard();
        }
    }

    // Show the admin dashboard
    public static function showDashboard() {
        include '../Views/adminView.php'; // Render the dashboard view
    }

    // View all users
    public static function viewUsers() {
        include '../Views/userslistView.php'; // Render the users list view
    }
    public static function getAllApplications($conn) {
        $sql = "SELECT ta.id, u.username, u.email, ta.location, ta.sport, ta.day_time, ta.certificate, ta.state
                FROM trainer_applications ta
                JOIN users u ON ta.user_id = u.id
                WHERE ta.state = 'pending'";
        $result = $conn->query($sql);
        return $result;
    }
    public static function acceptApplication($conn, $application_id, $user_id, $username, $email, $certificate, $location, $sport, $day_time) {
        // Insert into accepted_trainers
        $sql_insert = "INSERT INTO accepted_trainers (user_id, username, email, certificate, location, sport, day_time, state, approved_at)
                       VALUES (?, ?, ?, ?, ?, ?, ?, 'accepted', NOW())";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("issssss", $user_id, $username, $email, $certificate, $location, $sport, $day_time);

        if ($stmt_insert->execute()) {
            // Update application state to accepted
            $sql_update = "UPDATE trainer_applications SET state = 'accepted' WHERE id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("i", $application_id);
            $stmt_update->execute();
            return true;
        }
        return false;
    }
    public static function denyApplication($conn, $application_id) {
        // Update application state to denied
        $sql_update = "UPDATE trainer_applications SET state = 'denied' WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("i", $application_id);

        return $stmt_update->execute();
    }

    // Edit a user
    public static function editUser() {
        $conn = Database::getInstance()->getConnection();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id'])) {
            $id = intval($_POST['update_id']);
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);

            $result = AdminClass::updateUser($conn, $id, $username, $email);

            if ($result) {
                $_SESSION['message'] = "User updated successfully.";
            } else {
                $_SESSION['message'] = "Error updating user.";
            }
            header("Location: ../Controllers/adminController.php?page=viewUsers");
            exit();
        }
    }

    // Delete a user
    public static function deleteUser() {
        $conn = Database::getInstance()->getConnection();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $id = intval($_POST['delete_id']);

            $result = AdminClass::deleteUser($conn, $id);

            if ($result) {
                $_SESSION['message'] = "User deleted successfully.";
            } else {
                $_SESSION['message'] = "Error deleting user.";
            }
            header("Location: ../Controllers/adminController.php?page=viewUsers");
            exit();
        }
    }

    // Manage applications
    public static function manageApplications() {
        include '../Views/ApplicationsView.php'; // Render the applications view
    }

    // View all trainers
    public static function viewTrainers() {
        include '../Views/Trainerslist.php';
    }
   
    public static function getAllTrainers($conn) {
        $trainers = [];
        $sql = "SELECT * FROM accepted_trainers";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $trainers[] = $row;
            }
        }
        return $trainers;
    }
    
 
    
    // Add a new trainer
    public static function addTrainer() {
        $conn = Database::getInstance()->getConnection();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $location = trim($_POST['location']);
            $sport = trim($_POST['sport']);
            $timings = trim($_POST['timings']);

            $result = AdminClass::addTrainer($conn, $username, $email, $location, $sport, $timings);

            if ($result) {
                header('Location: ../Controllers/adminController.php?page=viewTrainers');
            } else {
                echo "Error adding trainer.";
            }
        }
    }

    // Update a trainer
    public static function updateTrainer() {
        $conn = Database::getInstance()->getConnection();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id'])) {
            $update_id = intval($_POST['update_id']);
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $location = trim($_POST['location']);
            $sport = trim($_POST['sport']);
            $day_time = trim($_POST['day_time']);
            $state = trim($_POST['state']);
        
            $update_query = "UPDATE accepted_trainers 
                             SET username = ?, email = ?, location = ?, sport = ?, day_time = ?, state = ? 
                             WHERE id = ?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param('ssssssi', $username, $email, $location, $sport, $day_time, $state, $update_id);
            
            if ($stmt->execute()) {
                $_SESSION['message'] = "Trainer updated successfully.";
            } else {
                $_SESSION['message'] = "Error updating trainer.";
            }
            
            // Include the trainers list view with the updated message
            self::viewTrainers(); // This will include 'Trainerslist.php' and display the message
            exit();
        }
    }
    

    // Delete a trainer
    public static function deleteTrainer() {
        $conn = Database::getInstance()->getConnection();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $delete_id = intval($_POST['delete_id']);
            $delete_query = "DELETE FROM accepted_trainers WHERE id = ?";
            $stmt = $conn->prepare($delete_query);
            $stmt->bind_param('i', $delete_id);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Trainer deleted successfully.";
            } else {
                $_SESSION['message'] = "Error deleting trainer.";
            }
            self::viewTrainers(); // This will include 'Trainerslist.php' and display the message
            exit();  } }
        
        
}

// Handle the incoming request
AdminController::handleRequest();

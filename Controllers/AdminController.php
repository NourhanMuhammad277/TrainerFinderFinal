<?php
session_start();
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
            case 'manageApplications':
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
        $conn = Database::getInstance()->getConnection();
        $applications = AdminClass::getApplications($conn);
        include '../Views/applicationsView.php'; // Render the applications view
    }

    // View all trainers
    public static function viewTrainers() {
        include '../Views/Trainerslist.php'; // Render the trainers list view
    }
   
    function getAllTrainers($conn) {
        $trainers = [];
        $sql = "SELECT id, username, location, sport, availability FROM accepted_trainers";
        $stmt = $conn->prepare($sql);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $trainers[] = $row;
            }
        } else {
            // Log or handle query execution errors if needed
            error_log("Error executing query: " . $conn->error);
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $location = trim($_POST['location']);
            $sport = trim($_POST['sport']);
            $timings = trim($_POST['timings']);

            $result = AdminClass::updateTrainer($conn, $id, $username, $email, $location, $sport, $timings);

            if ($result) {
                header('Location: ../Controllers/adminController.php?page=viewTrainers');
            } else {
                echo "Error updating trainer.";
            }
        }
    }

    // Delete a trainer
    public static function deleteTrainer() {
        $conn = Database::getInstance()->getConnection();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $id = intval($_POST['delete_id']);
            $result = AdminClass::deleteTrainer($conn, $id);

            if ($result) {
                header('Location: ../Controllers/adminController.php?page=viewTrainers');
            } else {
                echo "Error deleting trainer.";
            }
        }
    }
}

// Handle the incoming request
AdminController::handleRequest();

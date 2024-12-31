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
    public static function getAllApplications() {
        $conn = Database::getInstance()->getConnection();
        $sql = "SELECT ta.id,ta.user_id, u.username, u.email, ta.location, ta.sport, ta.day_time, ta.certificate, ta.state
                FROM trainer_applications ta
                JOIN users u ON ta.user_id = u.id
                WHERE ta.state = 'pending'";
        $result = $conn->query($sql);
        return $result;
    }
    public static function acceptApplication($application_id, $user_id, $username, $email, $certificate, $location, $sport, $day_time) {
        $conn = Database::getInstance()->getConnection();
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
    public static function denyApplication( $application_id) {
        // Update application state to denied
        $conn = Database::getInstance()->getConnection();
        $sql_update = "UPDATE trainer_applications SET state = 'denied' WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("i", $application_id);

        return $stmt_update->execute();
    }

    // Edit a user
    public static function editUser() {
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id'])) {
            $id = intval($_POST['update_id']);
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);

            $result = AdminClass::updateUser( id: $id, username: $username, email: $email);

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
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $id = intval($_POST['delete_id']);

            $result = AdminClass::deleteUser( $id);

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
   
    public static function getAllTrainers() {
        $conn = Database::getInstance()->getConnection();
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
       

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $location = trim($_POST['location']);
            $sport = trim($_POST['sport']);
            $timings = trim($_POST['timings']);

            $result = AdminClass::addTrainer( username: $username, email: $email, location: $location, sport: $sport, timings: $timings);

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
    
            $fetch_query = "SELECT user_id FROM accepted_trainers WHERE id = ?";
            $stmt = $conn->prepare($fetch_query);
            $stmt->bind_param('i', $delete_id);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $user_id = $row['user_id'];
    
                $update_query = "UPDATE trainer_applications SET state = ? WHERE user_id = ?";
                $stmt2 = $conn->prepare($update_query);
                $pending_state = 'pending';
                $stmt2->bind_param('si', $pending_state, $user_id);
    
                if ($stmt2->execute()) {
                    $delete_query = "DELETE FROM accepted_trainers WHERE id = ?";
                    $stmt3 = $conn->prepare($delete_query);
                    $stmt3->bind_param('i', $delete_id);
    
                    if ($stmt3->execute()) {
                        $_SESSION['message'] = "Trainer deleted successfully, and state updated to pending.";
                    } else {
                        $_SESSION['message'] = "Failed to delete trainer from accepted_trainers.";
                    }
                } else {
                    $_SESSION['message'] = "Failed to update state to pending.";
                }
            } else {
                $_SESSION['message'] = "Trainer not found.";
            }
    
            self::viewTrainers();
            exit();
        }
    }
        
        
}

// Handle the incoming request
AdminController::handleRequest();

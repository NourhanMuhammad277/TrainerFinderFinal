<?php
include_once '../Models/AdminClass.php'; // Include the model

class AdminController {

    // Show the admin dashboard
    public static function showDashboard() {
        include '../Views/dashboardView.php'; // Render the dashboard view
    }

    // Manage applications
    public static function manageApplications() {
        $conn = mysqli_connect('localhost', 'username', 'password', 'database'); // Your DB connection
        $applications = AdminClass::getApplications($conn);
        include '../Views/applicationsView.php'; // Render the applications view
    }

    // View all users
    public static function viewUsers() {
        $conn = mysqli_connect('localhost', 'username', 'password', 'database'); // Your DB connection
        $users = AdminClass::getUsers($conn);
        include '../Views/usersListView.php'; // Render the users list view
    }

    // View all trainers
    public static function viewTrainers() {
        $conn = mysqli_connect('localhost', 'username', 'password', 'database'); // Your DB connection
        $trainers = AdminClass::getTrainers($conn);
        include '../Views/trainersListView.php'; // Render the trainers list view
    }

    // Accept a trainer application
    public static function acceptApplication($applicationId) {
        $conn = mysqli_connect('localhost', 'username', 'password', 'database'); // Your DB connection
        $result = AdminClass::acceptApplication($conn, $applicationId);
        
        if ($result) {
            header('Location: ../Controllers/adminController.php?page=applications');
        } else {
            echo "Error accepting application.";
        }
    }

    // Reject a trainer application
    public static function rejectApplication($applicationId) {
        $conn = mysqli_connect('localhost', 'username', 'password', 'database'); // Your DB connection
        $result = AdminClass::rejectApplication($conn, $applicationId);
        
        if ($result) {
            header('Location: ../Controllers/adminController.php?page=applications');
        } else {
            echo "Error rejecting application.";
        }
    }

    // Edit a user
    public static function editUser($id) {
        $conn = mysqli_connect('localhost', 'username', 'password', 'database'); // Your DB connection
        $user = AdminClass::getUserById($conn, $id); // Assuming there's a method to fetch user by ID
        include '../Views/editUserView.php'; // Render the edit user view
    }

    // Update a user
    public static function updateUser() {
        $conn = mysqli_connect('localhost', 'username', 'password', 'database'); // Your DB connection
        $id = $_POST['id'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = AdminClass::updateUser($conn, $id, $email, $username, $password);
        
        if ($result) {
            header('Location: ../Controllers/adminController.php?page=users');
        } else {
            echo "Error updating user.";
        }
    }

    // Delete a user
    public static function deleteUser($id) {
        $conn = mysqli_connect('localhost', 'username', 'password', 'database'); // Your DB connection
        $result = AdminClass::deleteUser($conn, $id);
        
        if ($result) {
            header('Location: ../Controllers/adminController.php?page=users');
        } else {
            echo "Error deleting user.";
        }
    }

    // Edit a trainer
    public static function editTrainer($id) {
        $conn = mysqli_connect('localhost', 'username', 'password', 'database'); // Your DB connection
        $trainer = AdminClass::getTrainerById($conn, $id); // Fetch trainer by ID
        include '../Views/editTrainerView.php'; // Render the edit trainer view
    }

    // Update a trainer
    public static function updateTrainer() {
        $conn = mysqli_connect('localhost', 'username', 'password', 'database'); // Your DB connection
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $location = $_POST['location'];
        $sport = $_POST['sport'];
        $timings = $_POST['timings'];

        $result = AdminClass::updateTrainer($conn, $id, $username, $email, $location, $sport, $timings);
        
        if ($result) {
            header('Location: ../Controllers/adminController.php?page=trainers');
        } else {
            echo "Error updating trainer.";
        }
    }

    // Delete a trainer
    public static function deleteTrainer($id) {
        $conn = mysqli_connect('localhost', 'username', 'password', 'database'); // Your DB connection
        $result = AdminClass::deleteTrainer($conn, $id);
        
        if ($result) {
            header('Location: ../Controllers/adminController.php?page=trainers');
        } else {
            echo "Error deleting trainer.";
        }
    }

    // Add a new trainer
    public static function addTrainer() {
        $conn = mysqli_connect('localhost', 'username', 'password', 'database'); // Your DB connection
        $username = $_POST['username'];
        $email = $_POST['email'];
        $location = $_POST['location'];
        $sport = $_POST['sport'];
        $timings = $_POST['timings'];

        $result = AdminClass::addTrainer($conn, $username, $email, $location, $sport, $timings);
        
        if ($result) {
            header('Location: ../Controllers/adminController.php?page=trainers');
        } else {
            echo "Error adding trainer.";
        }
    }
}

// Handle the incoming request
AdminController::handleRequest();

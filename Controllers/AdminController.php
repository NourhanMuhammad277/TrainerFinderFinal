<?php
include_once '../Models/AdminClass.php';
include_once '../TrainerFinderFinal/db.php';  // This will include the db connection
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class AdminController {

    // Redirect with a message
    private static function redirect($url, $message = null) {
        if ($message) {
            $_SESSION['flash_message'] = $message;
        }
        header("Location: $url");
        exit;
    }

    // Main router method
    public static function handleRequest() {
        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

        try {
            switch ($page) {
                case 'dashboard':
                    self::showDashboard();
                    break;

                case 'applications':
                    self::manageApplications();
                    break;

                case 'users':
                    self::viewUsers();
                    break;

                case 'trainers':
                    self::viewTrainers();
                    break;

                case 'acceptApplication':
                    $id = isset($_GET['id']) ? $_GET['id'] : null;
                    if ($id) {
                        self::acceptApplication($id);
                    }
                    break;

                case 'rejectApplication':
                    $id = isset($_GET['id']) ? $_GET['id'] : null;
                    if ($id) {
                        self::rejectApplication($id);
                    }
                    break;

                case 'deleteUser':
                    $id = isset($_GET['id']) ? $_GET['id'] : null;
                    if ($id) {
                        self::deleteUser($id);
                    }
                    break;

                case 'deleteTrainer':
                    $id = isset($_GET['id']) ? $_GET['id'] : null;
                    if ($id) {
                        self::deleteTrainer($id);
                    }
                    break;

                default:
                    echo "Page not found.";
                    break;
            }
        } catch (Exception $e) {
            error_log("Error handling request for page '$page': " . $e->getMessage());
            echo "An error occurred. Please try again later.";
        }
    }

    public static function showDashboard() {
        include '../Views/dashboardView.php';
    }

    public static function manageApplications() {
        try {
            global $conn; // Use the database connection directly
            $applications = AdminClass::getApplications($conn);
            include '../Views/applicationsView.php';
        } catch (Exception $e) {
            error_log("Error fetching applications: " . $e->getMessage());
            echo "Failed to load applications. Please try again later.";
        }
    }

    public static function viewUsers() {
        try {
            global $conn; // Ensure the connection is available globally
            $users = AdminClass::getUsers($conn); // Pass $conn here
            include '../Views/usersListView.php';
        } catch (Exception $e) {
            error_log("Error fetching users: " . $e->getMessage());
            echo "Failed to load users. Please try again later.";
        }
    }
    
    public static function viewTrainers() {
        try {
            global $conn; // Use the database connection directly
            $trainers = AdminClass::getTrainers($conn);
            include '../Views/trainersListView.php';
        } catch (Exception $e) {
            error_log("Error fetching trainers: " . $e->getMessage());
            echo "Failed to load trainers. Please try again later.";
        }
    }

    public static function acceptApplication($applicationId) {
        try {
            global $conn; // Use the database connection directly
            if (AdminClass::acceptApplication($conn, $applicationId)) {
                self::redirect('../Controllers/adminController.php?page=applications', 'Application accepted successfully.');
            } else {
                self::redirect('../Controllers/adminController.php?page=applications', 'Error accepting application.');
            }
        } catch (Exception $e) {
            error_log("Error accepting application: " . $e->getMessage());
            self::redirect('../Controllers/adminController.php?page=applications', 'An error occurred while accepting the application.');
        }
    }

    public static function rejectApplication($applicationId) {
        try {
            global $conn; // Use the database connection directly
            if (AdminClass::rejectApplication($conn, $applicationId)) {
                self::redirect('../Controllers/adminController.php?page=applications', 'Application rejected successfully.');
            } else {
                self::redirect('../Controllers/adminController.php?page=applications', 'Error rejecting application.');
            }
        } catch (Exception $e) {
            error_log("Error rejecting application: " . $e->getMessage());
            self::redirect('../Controllers/adminController.php?page=applications', 'An error occurred while rejecting the application.');
        }
    }

    public static function deleteUser($id) {
        try {
            global $conn; // Use the database connection directly
            if (AdminClass::deleteUser($conn, $id)) {
                self::redirect('../Controllers/adminController.php?page=users', 'User deleted successfully.');
            } else {
                self::redirect('../Controllers/adminController.php?page=users', 'Error deleting user.');
            }
        } catch (Exception $e) {
            error_log("Error deleting user: " . $e->getMessage());
            self::redirect('../Controllers/adminController.php?page=users', 'An error occurred while deleting the user.');
        }
    }

    public static function deleteTrainer($id) {
        try {
            global $conn; // Use the database connection directly
            if (AdminClass::deleteTrainer($conn, $id)) {
                self::redirect('../Controllers/adminController.php?page=trainers', 'Trainer deleted successfully.');
            } else {
                self::redirect('../Controllers/adminController.php?page=trainers', 'Error deleting trainer.');
            }
        } catch (Exception $e) {
            error_log("Error deleting trainer: " . $e->getMessage());
            self::redirect('../Controllers/adminController.php?page=trainers', 'An error occurred while deleting the trainer.');
        }
    }
}

// Handle the incoming request
AdminController::handleRequest();

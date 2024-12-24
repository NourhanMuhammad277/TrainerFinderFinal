<?php
include_once '../db.php';  
include_once '../Models/User.php';
include_once '../Models/Admin.php';

class LoginSignupController {
    public static function handleRequest() {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        session_start();

        // Enable error reporting for debugging
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // global $conn; 

        $signup_error = '';
        $login_error = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitize and trim input data
            $email = trim($_POST['email']);
            $password = trim($_POST['pswd']);

            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_msg = "Please enter a valid email address.";
                if (isset($_POST['signup'])) {
                    $signup_error = $error_msg;
                } elseif (isset($_POST['login'])) {
                    $login_error = $error_msg;
                }
            } else {
                // Handle signup request
                if (isset($_POST['signup'])) {
                    $username = trim($_POST['txt']);
                    $confirm_password = trim($_POST['confirm_pswd']);

                    // Validate passwords
                    if ($password !== $confirm_password) {
                        $signup_error = "Passwords do not match.";
                    } else {
                        $existingUser = User::getUserByEmail($email);
                        if ($existingUser) {
                            $signup_error = "Email already exists.";
                        } else {
                            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                            $userCreated = User::createUser( $email, $hashed_password, $username);
                            if ($userCreated) {
                                // Set session variables and redirect to the profile page
                                $_SESSION['user_id'] = $conn->insert_id;
                                header("Location: ../Views/myProfile.php");
                                exit();
                            } else {
                                $signup_error = "Error: Could not create user.";
                            }
                        }
                    }
                }

                // Handle login request
                elseif (isset($_POST['login'])) {
                    // First, check if the email belongs to an admin
                    if ($email == "nourhan@gmail.com" && $password == "nourhan27122003") {
                        $_SESSION['admin_id'] = 1; 
                        $_SESSION['admin_username'] = "Nourhan"; 
                        header("Location: ../Views/adminView.php");
                        exit();
                    }

                    // Now, check if the email belongs to a regular user
                    $user = User::getUserByEmail( $email);
                    if ($user) {
                        // Verify the password
                        if (password_verify($password, $user['password'])) {
                            // Login successful for regular user
                            $_SESSION['user_id'] = $user['id']; 
                            $_SESSION['user_username'] = $user['username']; 
                            header("Location: ../Views/myProfile.php");
                            exit();
                        } 
                    } else {
                        $login_error = "Invalid email or password.";
                    }
                }
            }
        }
        include '../Views/LoginSignupView.php';
    }
}

LoginSignupController::handleRequest();
?>

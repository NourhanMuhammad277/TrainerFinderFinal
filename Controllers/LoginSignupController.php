<?php
include_once '../db.php';  
include_once '../Models/User.php';
include_once '../Models/AdminModel.php';

class LoginSignupController {
    public static function handleRequest() {
        $conn = Database::getInstance()->getConnection();

        session_start();

        // Enable error reporting for debugging
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // Initialize error messages
        $signup_error = '';
        $login_error = '';
        $email_signup_error = '';
        $password_signup_error = '';
        $username_error = '';
        $email_login_error = '';
        $password_login_error = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitize and trim input data
            $email_signup = trim($_POST['email_signup'] ?? '');
            $password_signup = trim($_POST['password_signup'] ?? '');
            $confirm_password = trim($_POST['confirm_password'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $email_login = trim($_POST['email_login'] ?? '');
            $password_login = trim($_POST['password_login'] ?? '');

            // Check if required fields are filled for login/signup
            if (isset($_POST['signup']) || isset($_POST['login'])) {
                // Email validation
                if (isset($_POST['signup'])) {
                    if (empty($email_signup)) {
                        $email_signup_error = "Please fill this field";
                    } elseif (!filter_var($email_signup, FILTER_VALIDATE_EMAIL)) {
                        $email_signup_error = "Please enter a valid email address.";
                    }
                }

                if (isset($_POST['login'])) {
                    if (empty($email_login)) {
                        $email_login_error = "Please fill this field";
                    } elseif (!filter_var($email_login, FILTER_VALIDATE_EMAIL)) {
                        $email_login_error = "Please enter a valid email address.";
                    }
                    if (empty($email_login)&& empty($password_login)) {
                        $email_login_error = "Please fill this field"; 
                        $password_login_error="Please fill this field";
                    }
                    if (empty($password_login))
                    {
                        $password_login_error="Please fill this field";
                    }
                    
                }

                // Username validation (only for signup)
                if (isset($_POST['signup']) && empty($username)) {
                    $username_error = "Please fill this field";
                }

                // Password validation
                if (isset($_POST['signup']) && empty($password_signup)) {
                    $password_signup_error = "Please fill this field";
                }

                if (isset($_POST['signup']) && $password_signup !== $confirm_password) {
                    $signup_error = "Passwords do not match.";
                }

                if (isset($_POST['signup']) && empty($confirm_password)) {
                    $signup_error = "Please fill this field";
                }

                // Handle signup
                if (isset($_POST['signup']) && empty($email_signup_error) && empty($password_signup_error) && empty($username_error) && empty($signup_error)) {
                    // Check if email already exists
                    $existingUser = User::getUserByEmail($email_signup);
                    if ($existingUser) {
                        $signup_error = "Email already exists.";
                    } else {
                        $hashed_password = password_hash($password_signup, PASSWORD_BCRYPT);
                        $userCreated = User::createUser($email_signup, $hashed_password, $username);
                        if ($userCreated) {
                        echo "<script>
                                alert('User created successfully!');
                                window.location.href = '../index.php';
                            </script>";
                        exit();
                    }
                        else {
                            $signup_error = "Error: Could not create user.";
                        }
                    }
                }

                // Handle login
                if (isset($_POST['login']) && empty($email_login_error) && empty($password_login_error)) {
                    // Check if the email belongs to an admin
                    if ($email_login == "nourhan@gmail.com" && $password_login == "nourhan27122003") {
                        $_SESSION['admin_id'] = 1;
                        $_SESSION['admin_username'] = "Nourhan"; 
                        header("Location: ../Views/adminView.php");
                        exit();
                    }

                    // Check if the email belongs to a regular user
                    $user = User::getUserByEmail($email_login);
                    if ($user && password_verify($password_login, $user['password'])) {
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user_username'] = $user['username'];
                        header("Location: ../Views/myProfile.php");
                        exit();
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

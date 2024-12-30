<?php
include_once '../db.php'; 
include_once '../Controllers/ProfileController.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Views/LoginSignupView.php");
    exit();
}
$profileController = new ProfileController($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form input
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    // Validate input
    if (empty($username) || empty($email)) {
        $_SESSION['error_message'] = "All fields are required.";
        header("Location: ../Views/myProfile.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = "Invalid email format.";
        header("Location: ../Views/myProfile.php");
        exit();
    }

    // Update user data through the controller
    $updateData = [
        'username' => $username,
        'email' => $email
    ];
    
    $message = $profileController->updateUserData($updateData);

    // Set session message and redirect
    if ($message === "Profile updated successfully!") {
        $_SESSION['success_message'] = $message;
    } else {
        $_SESSION['error_message'] = $message;
    }
    header("Location: ../Views/myProfile.php");
    exit();
}

?>
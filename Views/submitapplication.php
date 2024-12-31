<?php
session_start();
include_once '../Controllers/ProfileController.php';
include_once '../db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Views/LoginSignupView.php");
    exit();
}


$profileController = new ProfileController( $_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $location = trim($_POST['location']);
    $sport = trim($_POST['sport']);
    $dayTime = $_POST['dayTime'] ?? [];
    $certificate = $_FILES['certificate'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    // Validate input
    if (empty($location) || empty($sport) || empty($dayTime) || empty($certificate['name'])) {
        $_SESSION['error_message'] = "All fields are required.";
        header("Location: ../Views/myProfile.php");
        exit();
    }

    // File upload validation
    $allowedExtensions = ['pdf'];
    $fileExtension = pathinfo($certificate['name'], PATHINFO_EXTENSION);

    if (!in_array($fileExtension, $allowedExtensions)) {
       $_SESSION['error_message'] = "Only PDF files are allowed for the certificate.";
       header("Location: ../Views/myProfile.php");
     exit();
    }

   
// Upload file
$targetDir = "../Assets/uploads/";
$targetFile = $targetDir . basename($certificate['name']);

if (!file_exists($certificate['tmp_name'])) {
    echo "Temporary file does not exist: " . $certificate['tmp_name'];
    exit();
}

if (!is_writable($targetDir)) {
    echo "Target directory is not writable: " . $targetDir;
    exit();
}

if (!move_uploaded_file($certificate['tmp_name'], $targetFile)) {
    echo "File move failed. Temp file: " . $certificate['tmp_name'] . ", Target file: " . $targetFile;
    exit();
}




    // Prepare application data
    $applicationData = [
        'location' => $location,
        'sport' => $sport,
        'dayTime' => $dayTime,
        'certificate' => $certificate['name'],
        'username' => $username,
        'email' => $email
    ];

    // Submit trainer application
    $message = $profileController->handleTrainerApplication($applicationData, $_FILES);

    // Set session message and redirect
    if ($message) {
        $_SESSION['success_message'] = $message;
    } else {
        $_SESSION['error_message'] = $message;
    }
    header("Location: ../Views/myProfile.php");
    exit();
}
?>

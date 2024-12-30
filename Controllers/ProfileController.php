<?php
include_once '../Models/Profile.php';

class ProfileController {
    private $model;
    private $userId;

    public function __construct( $userId) {
        $this->model = new ProfileModel();
        $this->userId = $userId;
    }

    // Fetch user data
    public function getUserData() {
        $userData = $this->model->getUserData($this->userId);
        if ($userData) {
            return $userData;
        }
        return ["error" => "User not found."];
    }

    // Update user data
    public function updateUserData($data) {
        if (!isset($data['email']) || !isset($data['username'])) {
            return "Invalid input data.";
        }

        $email = $data['email'];
        $username = $data['username'];

        $success = $this->model->updateUserData($this->userId, $email, $username);
        return $success ? "Profile updated successfully!" : "Error updating profile.";
    }

    // Handle trainer application
    public function handleTrainerApplication($data, $files) {
        if (!isset($data['location'], $data['sport'], $data['dayTime']) || !isset($files['certificate']['name'])) {
            return "Invalid application data.";
        }

        $location = $data['location'];
        $sport = $data['sport'];
        $dayTime = implode(", ", $data['dayTime']);
        $certificate = $files['certificate']['name']; // Add file upload handling if necessary
        $username=$data['username'];
        $email=$data['email'];
        $success = $this->model->insertTrainerApplication($this->userId, $location, $sport, $dayTime, $certificate,$username,$email);
        return $success ;
    }
}
?>

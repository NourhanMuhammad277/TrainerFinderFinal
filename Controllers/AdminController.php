<?php
use \AdminModel;
class AdminController
{
    // Show the admin dashboard
    public static function showDashboard()
    {
        include "../Views/dashboardView.php"; // Render the dashboard view
    }

    // Manage applications
    public static function manageApplications()
    {
       
        $applications = AdminModel::getApplications();
        include "../Views/applicationsView.php"; // Render the applications view
    }

    // View all users
    public static function viewUsers()
    {
       
        $users = AdminModel::getUsers();
        include "../Views/usersListView.php"; // Render the users list view
    }

    // View all trainers
    public static function viewTrainers()
    {
       
        $trainers = AdminModel::getTrainers();
        include "../Views/trainersListView.php"; // Render the trainers list view
    }

    // Accept a trainer application
    public static function acceptApplication($applicationId)
    {
       
        $result = AdminModel::acceptApplication( $applicationId);

        if ($result) {
            header(
                "Location: ../Controllers/adminController.php?page=applications"
            );
        } else {
            echo "Error accepting application.";
        }
    }

    // Reject a trainer application
    public static function rejectApplication($applicationId)
    {
       
        $result = AdminModel::rejectApplication( $applicationId);

        if ($result) {
            header(
                "Location: ../Controllers/adminController.php?page=applications"
            );
        } else {
            echo "Error rejecting application.";
        }
    }

    // Edit a user
    public static function editUser($id)
    {
       
        $user = AdminModel::getUserById($id); // Assuming there's a method to fetch user by ID
        include "../Views/editUserView.php"; // Render the edit user view
    }

    // Update a user
    public static function updateUser()
    {
       
        $id = $_POST["id"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = AdminModel::updateUser(
            
            $id,
            $email,
            $username,
            $password
        );

        if ($result) {
            header("Location: ../Controllers/adminController.php?page=users");
        } else {
            echo "Error updating user.";
        }
    }

    // Delete a user
    public static function deleteUser($id)
    {
       
        $result = AdminModel::deleteUser( $id);

        if ($result) {
            header("Location: ../Controllers/adminController.php?page=users");
        } else {
            echo "Error deleting user.";
        }
    }

    // Edit a trainer
    public static function editTrainer($id)
    {
       
        $trainer = AdminModel::getTrainerById( $id); // Fetch trainer by ID
        include "../Views/editTrainerView.php"; // Render the edit trainer view
    }

    // Update a trainer
    public static function updateTrainer()
    {
       
        $id = $_POST["id"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $location = $_POST["location"];
        $sport = $_POST["sport"];
        $timings = $_POST["timings"];

        $result = AdminModel::updateTrainer(
            
            $id,
            $username,
            $email,
            $location,
            $sport,
            $timings
        );

        if ($result) {
            header(
                "Location: ../Controllers/adminController.php?page=trainers"
            );
        } else {
            echo "Error updating trainer.";
        }
    }

    // Delete a trainer
    public static function deleteTrainer($id)
    {
       
        $result = AdminModel::deleteTrainer($id);

        if ($result) {
            header(
                "Location: ../Controllers/adminController.php?page=trainers"
            );
        } else {
            echo "Error deleting trainer.";
        }
    }

    // Add a new trainer
    public static function addTrainer()
    {
       
        $username = $_POST["username"];
        $email = $_POST["email"];
        $location = $_POST["location"];
        $sport = $_POST["sport"];
        $timings = $_POST["timings"];

        $result = AdminModel::addTrainer(
            
            $username,
            $email,
            $location,
            $sport,
            $timings
        );

        if ($result) {
            header(
                "Location: ../Controllers/adminController.php?page=trainers"
            );
        } else {
            echo "Error adding trainer.";
        }
    }
}
?>

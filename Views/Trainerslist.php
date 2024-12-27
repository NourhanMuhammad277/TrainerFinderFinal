<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection and admin controller
include('../Controllers/AdminController.php'); // Contains updateTrainer, deleteTrainer, getAllTrainers functions

// Handle form submission for updating trainer details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id'])) {
    $trainer_id = $_POST['update_id'];
    $user_id = $_POST['user_id'];
    $certificate = $_POST['certificate'];
    $location = $_POST['location'];
    $sport = $_POST['sport'];
    $day_time = $_POST['day_time'];
    $state = $_POST['state'];

    $update_result = updateTrainer($trainer_id, $certificate, $location, $sport, $day_time, $state);

    if ($update_result) {
        echo "<script>alert('Trainer details updated successfully.'); window.location.href = 'trainerslist.php';</script>";
    } else {
        echo "<script>alert('Error updating trainer details.');</script>";
    }
}

// Handle trainer deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    $delete_result = deleteTrainer($delete_id);

    if ($delete_result) {
        echo "<script>alert('Trainer deleted successfully.'); window.location.href = 'trainerslist.php';</script>";
    } else {
        echo "<script>alert('Error deleting trainer.');</script>";
    }
}

// Fetch all trainers
$trainers = getAllTrainers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer List</title>
    <link rel="stylesheet" href="../Assets/CSS/lists.css">
    <link rel="stylesheet" href="../Assets/CSS/header-footer.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script defer src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <a class="navbar-brand" href="#">
        <img src="../Assets/Images/ss.png" alt="Logo"> Trainer Finder
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="admin.php">Admin Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="trainer_applications.php">Trainer Applications</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php">Log Out</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center mb-4">Trainer List</h2>
    <div class="card">
        <div class="card-body">
            <?php if ($trainers && count($trainers) > 0): ?>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Certificate</th>
                            <th>Location</th>
                            <th>Sport</th>
                            <th>Day/Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($trainers as $trainer): ?>
                            <tr>
                                <td><?= htmlspecialchars($trainer['id']); ?></td>
                                <td><?= htmlspecialchars($trainer['user_id']); ?></td>
                                <td>
                                    <a href="uploads/<?= htmlspecialchars($trainer['certificate']); ?>" target="_blank">View Certificate</a>
                                </td>
                                <td><?= htmlspecialchars($trainer['location']); ?></td>
                                <td><?= htmlspecialchars($trainer['sport']); ?></td>
                                <td><?= htmlspecialchars($trainer['day_time']); ?></td>
                                <td><?= htmlspecialchars($trainer['state']); ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" onclick="openEditModal(
                                        <?= htmlspecialchars($trainer['id']); ?>, 
                                        '<?= htmlspecialchars($trainer['user_id']); ?>',
                                        '<?= htmlspecialchars($trainer['certificate']); ?>', 
                                        '<?= htmlspecialchars($trainer['location']); ?>', 
                                        '<?= htmlspecialchars($trainer['sport']); ?>', 
                                        '<?= htmlspecialchars($trainer['day_time']); ?>', 
                                        '<?= htmlspecialchars($trainer['state']); ?>'
                                    )">Edit</button>
                                    <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?')">
                                        <input type="hidden" name="delete_id" value="<?= htmlspecialchars($trainer['id']); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center">No trainers found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>

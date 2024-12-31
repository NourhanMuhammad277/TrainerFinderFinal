<?php
session_start();
include_once '../db.php';

$db = Database::getInstance();
$conn = $db->getConnection();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Views/LoginSignupView.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM accepted_trainers WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

$trainer = $result->fetch_assoc();

$comments_query = "SELECT Reviews FROM accepted_trainers WHERE user_id = ?";
$comments_stmt = $conn->prepare($comments_query);
$comments_stmt->bind_param('i', $user_id);
$comments_stmt->execute();
$comments_result = $comments_stmt->get_result();
$comments_data = $comments_result->fetch_assoc();

$comments = !empty($comments_data['feedback']) ? explode(';', $comments_data['feedback']) : [];



$reservations_query = "SELECT reservations FROM accepted_trainers WHERE user_id = ?";
$reservations_stmt = $conn->prepare($reservations_query);
$reservations_stmt->bind_param('i', $user_id);
$reservations_stmt->execute();
$reservations_result = $reservations_stmt->get_result();
$reservations_data = $reservations_result->fetch_assoc();

$reservations = !empty($reservations_data['reservations']) ? explode(',', $reservations_data['reservations']) : [];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Profile | Trainer Finder</title>
    <link rel="stylesheet" href="../Assets/CSS/header-footer.css">
    <link rel="stylesheet" href="../Assets/CSS/Profile.css">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <a class="navbar-brand" href="#">
        <img src="../assets/images/ss.png" alt="Logo" style="height:30px; width:30px; margin-right:10px;">
        Trainer Finder
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="Home.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="trainers.php">Trainers</a></li>
            <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                    <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="myProfile.php">View Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Log Out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center mb-4">Trainer Profile</h2>
    <div class="card">
       <div class="card-body">
    <h5 class="card-title text-center">Profile Information</h5>
    <?php if ($trainer): ?>
        <p><strong>Name:</strong> <?= htmlspecialchars($trainer['username']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($trainer['email']) ?></p>
        <p><strong>Location:</strong> <?= htmlspecialchars($trainer['location']) ?></p>
        <p><strong>Sport:</strong> <?= htmlspecialchars($trainer['sport']) ?></p>
        <p><strong>Day/Time:</strong> <?= htmlspecialchars($trainer['day_time']) ?></p>
        <p><strong>Certificate:</strong> <a href="../Assets/uploads/<?= htmlspecialchars($trainer['certificate']) ?>" target="_blank">View Certificate</a></p>
        
        <h5 class="mt-4">Feedback/Comments</h5>
        <?php if (!empty($comments)): ?>
            <ul>
                <?php foreach ($comments as $comment): ?>
                    <li><?= htmlspecialchars($comment) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-center">No feedbacks or comments yet.</p>
        <?php endif; ?>

        <h5 class="mt-4">Reservations</h5>
        <?php if (!empty($reservations)): ?>
            <ul>
                <?php foreach ($reservations as $reservation): ?>
                    <li><?= htmlspecialchars($reservation) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-center">No reservations yet.</p>
        <?php endif; ?>
    <?php else: ?>
        <p class="text-center text-danger">Trainer information not found.</p>
    <?php endif; ?>
    </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</html>

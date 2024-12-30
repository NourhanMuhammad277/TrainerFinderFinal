<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection and controller
include_once '../Controllers/AdminController.php';


// Fetch all pending applications
$applications = AdminController::getAllApplications();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Applications | Trainer Finder</title>
    <link rel="stylesheet" href="../Assets/CSS/lists.css">
    <link rel="stylesheet" href="../Assets/CSS/header-footer.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script defer src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script defer src="../Assets/JS/lists.js"></script>
    <script>
        function confirmAction(action) {
            return confirm(`Are you sure you want to ${action} this application?`);
        }
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">Trainer Finder</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="../Views/adminView.php">Admin Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="../Views/LoginSignupView.php">Log Out</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center mb-4">Trainer Applications</h2>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info">
            <?= $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <?php if ($applications && $applications->num_rows > 0): ?>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Sport</th>
                            <th>Day/Time</th>
                            <th>Certificate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($application = $applications->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($application['id']) ?></td>
                                <td><?= htmlspecialchars($application['username']) ?></td>
                                <td><?= htmlspecialchars($application['email']) ?></td>
                                <td><?= htmlspecialchars($application['location']) ?></td>
                                <td><?= htmlspecialchars($application['sport']) ?></td>
                                <td><?= htmlspecialchars($application['day_time']) ?></td>
                                <td>
                                    <a href="uploads/<?= htmlspecialchars($application['certificate']) ?>" target="_blank">View Certificate</a>
                                </td>
                                <td>
                                    <form method="POST" style="display:inline;" onsubmit="return confirmAction('accept')">
                                        <input type="hidden" name="application_id" value="<?= htmlspecialchars($application['id']) ?>">
                                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($application['user_id']) ?>">
                                        <input type="hidden" name="username" value="<?= htmlspecialchars($application['username']) ?>">
                                        <input type="hidden" name="email" value="<?= htmlspecialchars($application['email']) ?>">
                                        <input type="hidden" name="certificate" value="<?= htmlspecialchars($application['certificate']) ?>">
                                        <input type="hidden" name="location" value="<?= htmlspecialchars($application['location']) ?>">
                                        <input type="hidden" name="sport" value="<?= htmlspecialchars($application['sport']) ?>">
                                        <input type="hidden" name="day_time" value="<?= htmlspecialchars($application['day_time']) ?>">
                                        <button type="submit" name="action" value="accept" class="btn btn-success btn-sm">Accept</button>
                                    </form>
                                    <form method="POST" style="display:inline;" onsubmit="return confirmAction('deny')">
                                        <input type="hidden" name="application_id" value="<?= htmlspecialchars($application['id']) ?>">
                                        <button type="submit" name="action" value="deny" class="btn btn-danger btn-sm">Deny</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center">No pending applications at the moment.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $application_id = $_POST['application_id'];
    
    if ($action == 'accept') {
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $certificate = $_POST['certificate'];
        $location = $_POST['location'];
        $sport = $_POST['sport'];
        $day_time = $_POST['day_time'];

        if (AdminController::acceptApplication( application_id: $application_id, user_id: $user_id, username: $username, email: $email, certificate: $certificate, location: $location, sport: $sport, day_time: $day_time)) {
            $_SESSION['message'] = 'Application accepted successfully!';
        } else {
            $_SESSION['message'] = 'Failed to accept application.';
        }
    } elseif ($action == 'deny') {
        if (AdminController::denyApplication( application_id: $application_id)) {
            $_SESSION['message'] = 'Application denied successfully!';
        } else {
            $_SESSION['message'] = 'Failed to deny application.';
        }
    }

    header('Location: adminView.php');
}
?>

</body>
</html>

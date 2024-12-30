<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../Controllers/AdminController.php';


$trainers = AdminController::getAllTrainers();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accepted Trainers | Trainer Finder</title>
    <link rel="stylesheet" href="../Assets/CSS/lists.css">
    <link rel="stylesheet" href="../Assets/CSS/header-footer.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script defer src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script defer src="../Assets/JS/lists.js"></script>
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
    <h2 class="text-center mb-4">Accepted Trainers</h2>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info">
            <?= $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <?php if (!empty($trainers)): ?>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
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
                                <td><?= htmlspecialchars($trainer['id']) ?></td>
                                <td><?= htmlspecialchars($trainer['username']) ?></td>
                                <td><?= htmlspecialchars($trainer['email']) ?></td>
                                <td><?= htmlspecialchars($trainer['location']) ?></td>
                                <td><?= htmlspecialchars($trainer['sport']) ?></td>
                                <td><?= htmlspecialchars($trainer['day_time']) ?></td>
                                <td><?= htmlspecialchars($trainer['state']) ?></td>
                                <td>
                                    <form method="POST" style="display:inline;" onsubmit="return confirmDelete()">
                                        <input type="hidden" name="delete_id" value="<?= htmlspecialchars($trainer['id']) ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <button type="button" class="btn btn-warning btn-sm" onclick="openEditModal(
                                        <?= htmlspecialchars($trainer['id']) ?>,
                                        '<?= htmlspecialchars($trainer['username']) ?>',
                                        '<?= htmlspecialchars($trainer['email']) ?>',
                                        '<?= htmlspecialchars($trainer['location']) ?>',
                                        '<?= htmlspecialchars($trainer['sport']) ?>',
                                        '<?= htmlspecialchars($trainer['day_time']) ?>',
                                        '<?= htmlspecialchars($trainer['state']) ?>'
                                    )">Edit</button>
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

<!-- Edit Trainer Modal -->
<div class="modal fade" id="editTrainerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="../Controllers/AdminController.php?page=updateTrainer">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Trainer</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="update_id">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" id="edit_username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" class="form-control" id="edit_location" name="location" required>
                    </div>
                    <div class="form-group">
                        <label>Sport</label>
                        <input type="text" class="form-control" id="edit_sport" name="sport" required>
                    </div>
                    <div class="form-group">
                        <label>Day/Time</label>
                        <input type="text" class="form-control" id="edit_day_time" name="day_time" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control" id="edit_state" name="state" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

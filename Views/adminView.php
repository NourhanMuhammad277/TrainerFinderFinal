<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Trainer Finder</title>
    <link rel="stylesheet" href="../Assets/CSS/admin.css">
    <link rel="stylesheet" href="../Assets/CSS/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <a class="navbar-brand" href="#">
            <img src="../Assets/Images/ss.png" alt="Logo">
            Trainer Finder
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../Controllers/adminController.php?page=dashboard">Admin Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> Admin
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../Views/LoginSignupView.php">Log Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content">
        <h1 class="text-center mb-4">Admin Dashboard</h1>

        <div class="admin-section">
            <h2>Manage Trainer Applications</h2>
            <p>Review and approve or reject trainer applications.</p>
            <?php if (isset($applications) && !empty($applications)): ?>
                <table class="table table-bordered">
                    <tr><th>ID</th><th>Trainer</th><th>Status</th><th>Actions</th></tr>
                    <?php foreach ($applications as $application): ?>
                        <tr>
                            <td><?= $application['id'] ?></td>
                            <td><?= $application['trainer'] ?></td>
                            <td><?= $application['status'] ?></td>
                            <td>
                                <a href="../Controllers/adminController.php?page=applications&action=accept&id=<?= $application['id'] ?>" class="btn btn-success btn-sm">Accept</a>
                                <a href="../Controllers/adminController.php?page=applications&action=reject&id=<?= $application['id'] ?>" class="btn btn-danger btn-sm">Reject</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No applications to manage.</p>
            <?php endif; ?>
            <button onclick="location.href='../Controllers/adminController.php?page=applications'">Go to Applications</button>
        </div>

        <div class="admin-section">
            <h2>View All Users</h2>
            <p>View and manage the users registered on the platform.</p>
            <?php if (isset($users) && !empty($users)): ?>
                <table class="table table-bordered">
                    <tr><th>ID</th><th>Email</th><th>Username</th><th>Actions</th></tr>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td>
                                <a href="../Controllers/adminController.php?page=editUser&id=<?= $user['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="../Controllers/adminController.php?page=deleteUser&id=<?= $user['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No users found.</p>
            <?php endif; ?>
            <button onclick="location.href='../Controllers/adminController.php?page=users'">View Users</button>
        </div>

        <div class="admin-section">
            <h2>View All Trainers</h2>
            <p>View and manage the trainers registered on the platform.</p>
            <?php if (isset($trainers) && !empty($trainers)): ?>
                <table class="table table-bordered">
                    <tr><th>ID</th><th>Username</th><th>Email</th><th>Location</th><th>Sport</th><th>Timings</th></tr>
                    <?php foreach ($trainers as $trainer): ?>
                        <tr>
                            <td><?= $trainer['id'] ?></td>
                            <td><?= $trainer['username'] ?></td>
                            <td><?= $trainer['email'] ?></td>
                            <td><?= $trainer['location'] ?></td>
                            <td><?= $trainer['sport'] ?></td>
                            <td><?= $trainer['timings'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No trainers found.</p>
            <?php endif; ?>
            <button onclick="location.href='../Controllers/adminController.php?page=trainers'">View Trainers</button>
        </div>
    </div>

    <footer class="footer">
        <div class="container text-center">
            <h4>Contact Us</h4>
            <ul class="contact-info">
                <li>Email: nourhanmuhammad@trainerfinder.com</li>
                <li>Phone: +1 234 567 890</li>
                <li>Address: 123 Fitness Lane, Workout City, USA</li>
            </ul>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <p>&copy; 2024 Trainer Finder. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

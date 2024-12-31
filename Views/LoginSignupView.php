<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Finder</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Assets/CSS/LoginSignup.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success" id="nav">
    <a class="navbar-brand" href="#">
        <img src="../Assets/Images/ss.png" alt="Logo"> Trainer Finder
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Views/Trainers/index.php">Trainers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Views/about.php">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Views/LoginSignupView.php"><i class="fas fa-user"></i></a>
            </li>
        </ul>
    </div>
</nav>

<div class="main">
    <input type="checkbox" id="chk" aria-hidden="true">

    <!-- Sign Up Form -->
    <div class="signup">
        <form id="signupForm" action="../Controllers/LoginSignupController.php" method="POST">
            <label for="chk" aria-hidden="true">Sign up</label>

            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="User name" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                <div class="error-message"><?= $username_error ?? '' ?></div>
            </div>

            <div class="form-group">
                <input type="email" name="email_signup" id="email_signup" placeholder="Email" value="<?= htmlspecialchars($_POST['email_signup'] ?? '') ?>">
                <div class="error-message"><?= $email_signup_error ?? '' ?></div>
            </div>

            <div class="form-group">
                <input type="password" name="password_signup" id="password_signup" placeholder="Password">
                <div class="error-message"><?= $password_signup_error ?? '' ?></div>
            </div>

            <div class="form-group">
                <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm Password">
                <div class="error-message"><?= $signup_error ?? '' ?></div>
            </div>

            <button type="submit" name="signup">Sign up</button>
        </form>
    </div>

    <!-- Login Form -->
    <div class="login">
        <form id="loginForm" action="../Controllers/LoginSignupController.php" method="POST">
            <label for="chk" aria-hidden="true">Login</label>

            <!-- Error message for invalid login attempt -->
            <div class="form-group">
                <input type="email" name="email_login" id="email_login" placeholder="Email" value="<?= htmlspecialchars($_POST['email_login'] ?? '') ?>">
                <div class="error-message"><?= $email_login_error ?? '' ?></div>
            </div>

            <div class="form-group">
                <input type="password" name="password_login" id="password_login" placeholder="Password">
                <div class="error-message"><?= $password_login_error ?? '' ?></div>
            </div>

            <!-- Display "Invalid email or password" below the button if login fails -->
  
            <?php if ($login_error): ?>
                <div class="error-message"><?= $login_error ?></div>
            <?php endif; ?>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

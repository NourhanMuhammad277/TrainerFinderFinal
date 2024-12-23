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
            <img src="../Assets/Images/ss.png" alt="Logo">
            Trainer Finder
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
                    <a class="nav-link" href="trainers.php">Trainers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Views/about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="LoginSignupView.php"><i class="fas fa-user"></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="main">
    <input type="checkbox" id="chk" aria-hidden="true">

    <div class="signup">
    <form id="signupForm" action="../Controllers/LoginSignupController.php" method="POST">
        <label for="chk" aria-hidden="true">Sign up</label>

        <div class="form-group">
            <input type="text" name="txt" id="username" placeholder="User name" value="<?= htmlspecialchars($_POST['txt'] ?? '') ?>">
            <div class="error-message"><?= $signup_error ?? '' ?></div>
        </div>

        <div class="form-group">
            <input type="email" name="email" id="email" placeholder="Email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            <div class="error-message"><?= $signup_error ?? '' ?></div>
        </div>

        <div class="form-group">
            <input type="password" name="pswd" id="password" placeholder="Password">
            <div class="error-message"><?= $signup_error ?? '' ?></div>
        </div>

        <div class="form-group">
            <input type="password" name="confirm_pswd" id="confirmPassword" placeholder="Confirm Password">
            <div class="error-message"><?= $signup_error ?? '' ?></div>
        </div>

        <button type="submit" name="signup">Sign up</button>
    </form>
</div>


    <!-- Login Form -->
    <div class="login">
        <form id="loginForm" action="../Controllers/LoginSignupController.php" method="POST">
            <label for="chk" aria-hidden="true">Login</label>
            <input type="email" name="email" id="loginEmail" placeholder="Email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            <div class="error-message"><?= $login_error ?? '' ?></div>
            <input type="password" name="pswd" id="loginPassword" placeholder="Password">
            <div class="error-message"><?= $login_error ?? '' ?></div>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

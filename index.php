<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Find Your Trainer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/CSS/header-footer.css">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        .video-container {
            position: relative;
            height: 100vh; /* Use viewport height to ensure full screen */
            overflow: hidden;
        }

        .background-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .overlay {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            color: white;
            text-align: left;
            z-index: 1;
        }

        .animated-text {
            font-size: 3rem;
            font-weight: bold;
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .join-button {
            margin-top: 20px;
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            background-color: #28a745;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .join-button:hover {
            background-color: #218838;
            color: white;
        }

        .navbar-nav {
            font-size: 1.1rem;
        }

        .navbar-nav .nav-item .nav-link {
            color: white !important;
        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #28a745 !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <a class="navbar-brand" href="#">
            <img src="../TrainerFinderFinal/Assets/Images/ss.png" alt="Logo" style="height:30px; width:30px; margin-right:10px;">
            Trainer Finder
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/TrainerFinderFinal/Views/Trainers/index.php">Trainers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/TrainerFinderFinal/Views/about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/TrainerFinderFinal/Views/LoginSignupView.php"><i class="fas fa-user"></i></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="video-container">
        <video autoplay muted loop class="background-video">
            <source src="../TrainerFinderFinal/Assets/Videos/main.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="overlay">
            <h1 class="animated-text text-success">Welcome to Find Your Trainer</h1>
            <button class="join-button">JOIN US</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.querySelector('.join-button').addEventListener('click', function() {
            window.location.href = '../TrainerFinderFinal/Views/LoginSignupView.php';
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Find Your Trainer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./Assets/CSS/header-footer.css">
    <link rel="stylesheet" href="./Assets/CSS/index.css">
    
</head>

<body>

  <?php  
  include_once './Views/components/nav.php'; ?>
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

<?php
session_start();
require_once(__DIR__ . '/../../Controllers/FinderController.php');
include_once("../components/head.php");
?>

<body class="">
    <?php
    include_once("../components/nav.php");
    ?>
    <br>
    <?php

    $trainers = FinderController::index();
    $success1;
    $searchedTrainers = false;
    //handle subscribe
    $currentUserId = isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null;
    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['Subscribe']) and $currentUserId != null) {
        $trainer_id = $_POST['trainer_id'];
        $success1 = FinderController::subscribe(trainer_id: $trainer_id, user_id: $currentUserId);
        $message = $success1 ? 'Successfully subcscribed' : 'Failed to subscribe';
    } else {
        $message = 'Please login to subscribe';
    }
    //handle search
    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['Search'])) {
        $sport = $_POST['sport'];
        $location = $_POST['location'];
        $searchedTrainers = array_filter($trainers, function ($trainer) use ($sport, $location) {
            return ($trainer['sport'] == $sport && $trainer['location'] == $location);
        });
    }
    ?>

    <div class="container-fluid py-5">
        <form method="post" class="mb-4">
            <div class="row justify-content-center">
                <div class="col-md-6 bg-light p-4 rounded shadow-sm">
                    <div class="form-group" style="max-width: 50%;">
                        <label for="location">Location</label>
                        <select class="form-control" id="location" name="location" style="max-width: 50%;">
                            <option value="" disabled selected>Select your location</option>
                            <option value="New Cairo">New Cairo</option>
                            <option value="Nasr City">Nasr City</option>
                            <option value="Sheraton">Sheraton</option>
                            <option value="Korba">Korba</option>
                            <option value="Manial">Manial</option>
                            <option value="6th of October">6th of October</option>
                            <option value="Dokki">Dokki</option>
                        </select>
                    </div>
                    <div class="form-group" style="max-width: 50%;">
                        <label for="sport">Sport</label>
                        <select class="form-control" id="sport" name="sport" style="max-width: 50%;">
                            <option value="" disabled selected>Select your sport</option>
                            <option value="Squash">Squash</option>
                            <option value="Padel">Padel</option>
                            <option value="Basketball">Basketball</option>
                            <option value="Tennis">Tennis</option>
                            <option value="Football">Football</option>
                            <option value="Boxing">Boxing</option>
                        </select>
                    </div>
                    <input type="submit" value="Search" name="Search" class="btn btn-primary btn-lg" />
                </div>
            </div>
        </form>

        <?php if ($searchedTrainers != null): ?>
            <div class="container d-flex p-2 justify-content-center">
                <ul class="list-group w-75">
                    <?php foreach ($searchedTrainers as $tr): ?>
                        <form action="" method="post" class="mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <li class="list-group-item border-0">
                                        <h1 class="display-4 mb-3"><?= $tr['username'] ?></h1>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <p class="lead"><i class="fas fa-envelope mr-2"></i><?= $tr['email'] ?></p>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <p class="lead"><i class="fas fa-map-marker-alt mr-2"></i><?= $tr['location'] ?></p>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <p class="lead"><i class="fas fa-running mr-2"></i><?= $tr['sport'] ?></p>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <p class="lead"><i class="far fa-clock mr-2"></i><?= $tr['day_time'] ?></p>
                                    </li>
                                    <input type="hidden" name="trainer_id" value="<?= $tr['id'] ?>" />
                                    <input type="submit" value="Subscribe" name="Subscribe" class="btn btn-success btn-lg btn-block mt-3" />
                                </div>
                            </div>
                        </form>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <?php include_once "../components/footer.php" ?>
</body>

</html>
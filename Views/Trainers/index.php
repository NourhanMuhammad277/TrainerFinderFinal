<?php
session_start();
require_once(__DIR__ . '/../../Controllers/FinderController.php');
include_once("../components/head.php");
?>

<body class="" >
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


    <form action="" method="post">
        <div class="container">

            <div class="form-group " style="max-width: 50%;">
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
            <input type="submit" value="Search" name="Search" class="btn btn-primary " />
        </div>
    </form>


    <?php if ($searchedTrainers != null): ?>
        <div class="container d-flex p-2 justify-content-center   ">
            <ul class="list-group  ">

                <?php foreach ($searchedTrainers as $tr): ?>
                    <form action="" method="post" class="pb-2">
                        <li class="list-group-item  ">
                            <h1>
                                <p><?= $tr['username'] ?></p>
                            </h1>
                        </li>
                        <li class="list-group-item ">
                            <p><?= $tr['email'] ?></p>
                        </li>

                        <li class="list-group-item ">
                            <p><?= $tr['location'] ?></p>
                        </li>
                        <li class="list-group-item ">
                            <p><?= $tr['sport'] ?></p>
                        </li>
                        <li class="list-group-item ">
                            <p><?= $tr['day_time'] ?></p>
                        </li>



                        <!-- this is so dumb this is why i wanted laravel u cant convince me this is good -->
                        <input type="hidden" name="trainer_id" value="<?= $tr['id'] ?>" />

                        <!--  $_SESSION['user_id'] -->
                        <input type="submit" value="Subscribe" name="Subscribe" class="btn btn-primary " style="margin-inline-start: 6rem;" />
                    </form>

                <?php endforeach ?>
            </ul>

        </div>
        <!-- php else -->
        <!-- <p>No trainers found.</p> -->
    <?php endif ?>
    <?php include_once "../components/footer.php" ?>
</body>

</html>
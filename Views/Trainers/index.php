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

    $currentUserId = isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null;
    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['Subscribe']) and $currentUserId != null) {
        $trainer_id = $_POST['trainer_id'];
        $success1 = FinderController::subscribe(trainer_id: $trainer_id, user_id: $currentUserId);
        $message = $success1 ? 'Successfully subcscribed' : 'Failed to subscribe';
    } else {
        $message = 'Please login to subscribe';
    }

    ?>

    <?php if ($trainers): ?>
        <div class="container d-flex p-2 justify-content-center   ">
            <ul class="list-group  ">

                <?php foreach ($trainers as $tr): ?>
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
    <?php else : ?>
        <p>No trainers found.</p>
    <?php endif ?>
    <?php include_once "../components/footer.php" ?>
</body>

</html>
<?php
require_once(__DIR__ . '/../../Controllers/FinderController.php');
include_once("../components/head.php");
?>

<body>
    <?php
    include_once("../components/nav.php");
    ?>
    <br>
    <?php

    $trainers = FinderController::index();

    function handleSubscribe(int $trainer_id): void
    {
        $currentUserId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['subscribe']) and $currentUserId != null) {
            FinderController::subscribe(trainer_id: $trainer_id, user_id: $currentUserId);
            $message = "Subscribed successfully";
        } else {
            $message = "Please login to subscribe";
        }
    }

    ?>
    <?php if (isset($message)): ?>
        <div class="alert"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <?php if ($trainers): ?>
        <div>
            <ul>

                <?php foreach ($trainers as $tr): ?>
                    <form action="" method="post">
                        <li>
                            <h1>
                                <p><?= $tr['username'] ?></p>
                            </h1>
                        </li>
                        <li>
                            <p><?= $tr['email'] ?></p>
                        </li>
                        <a href=<?= __DIR__ . "/../../Assets/Uploads" . $tr["certificate"] ?>>
                            <li>
                                <p><?= $tr['certificate'] ?></p>
                            </li>
                        </a>
                        <li>
                            <p><?= $tr['location'] ?></p>
                        </li>
                        <li>
                            <p><?= $tr['sport'] ?></p>
                        </li>
                        <li>
                            <p><?= $tr['day_time'] ?></p>
                        </li>
                        <li>
                            <p><?= $tr['state'] ?></p>
                        </li>


                        <!-- this is so dumb this is why i wanted laravel u cant convince me this is good -->
                        <input type="hidden" name="trainer_id" value="<?= $tr['user_id'] ?>" />

                        <!--  $_SESSION['user_id'] -->
                        <input type="submit" value="Subscribe" name="subscribe" />
                    </form>

                <?php endforeach ?>
            </ul>

        </div>
    <?php else : ?>
        <p>No trainers found.</p>
    <?php endif ?>

</body>
</html>
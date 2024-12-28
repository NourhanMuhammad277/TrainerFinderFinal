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

    ?>
    <?php if ($trainers): ?>
        <div>
            <ul>

                <?php foreach ($trainers as $tr): ?>
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
                <?php endforeach ?>
            </ul>

        </div>
    <?php else : ?>
        <p>No trainers found.</p>
    <?php endif ?>



</body>

</html>
<?php
include_once("../components/head.php");
?>

<body>
    <?php include_once("../components/nav.php"); ?>



helllooo
    <?php

    use FinderController;

    $trainers = FinderController::index();
    foreach ($trainers as $trainer) {
        echo "<h1>" . $trainer["location"] . "</h1>";
        echo "<h1>" . $trainer[0]["location"] . "</h1>";
        echo "<h1>" . $trainer[0][0]["location"] . "</h1>";
        echo "<h1>" . $trainer[0]. "</h1>";
    }
    ?>


</body>
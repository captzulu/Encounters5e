<?php
include 'controllers/controllerAPI.php';
include_once 'includes/header.php';
$results = CallJSON("Monsters");
//var_dump($results);
?>

<div class="grid-x grid-margin-x small-up-2 medium-up-4 large-up-5">
    <?php
    foreach ($results as $key => $result) {
        ?>
        <div class="cell ">
            <div class="card spell">
                <div class="card-divider ">
                    <h4 class="title"><?= $result["name"]; ?></h4>
                </div>
                <div class="card-section">
                    <span class="challenge_rating label">CR : <?= $result["challenge_rating"]; ?></span>
                    <span class="size label"><?= ucfirst($result["size"]); ?></span>
                    <span class="type label"><?= ucfirst($result["type"]); ?></span>
                    <?php if (!empty($result["subtype"])) {
                        ?><span class="subtype label secondary"><?= ucfirst($result["subtype"]); ?></span><?php }
                    ?>
                    <span class="alignment label"><?= ucfirst($result["alignment"]); ?></span>
                </div>
                <div class="card-section">
                    <span class=""><?php drawIcon("HP"); ?><?= $result["hit_points"] . " (" . $result["hit_dice"] . ")"; ?></span>
                    <span class=""><?php drawIcon("AC"); ?><?= $result["armor_class"]; ?></span>
                    <span class=""><?php drawIcon("Speed"); ?><?= $result["speed"]; ?></span>
                </div>

            </div>
        </div>
        <?php
    }
    ?>
</div>



<?php
include_once('includes/footer.php');

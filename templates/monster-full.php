<div class="card spell">
    <div class="card-divider ">
        <h4 class="title name"><?= $result["name"]; ?></h4>
    </div>
    <div class="card-section">
        <span class="challenge_rating label">CR : <?= $result["challenge_rating"]; ?></span>
        <span class="size label"><?= ucfirst($result["size"]); ?></span>
        <span class="type label"><?= ucfirst($result["type"]); ?></span>
        <?php if(!empty($result["subtype"])) {
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


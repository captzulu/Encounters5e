<?php
$idSpell = $result["idSpell"];
$result = $result["content"];
?>
<div class="card">
    <a  href="spell.php?id=<?= $idSpell; ?>">
        <div class="card-divider ">
            <h4 class="title name"><?= $result["name"]; ?></h4>
        </div>
    </a>
    <div class="card-section first_section">
        <div class="grid-x text-center">
            <div class="cell small-2"><?= "<b>LvL</b>"; ?></div>
            <div class="cell small-5"><?= "<b>Casting</b>"; ?></div>
            <div class="cell small-5"><?= "<b>Duration</b>"; ?></div>
        </div>
        <div class="grid-x text-center">
            <div class="cell small-2"><?= $result["level"]; ?></div>
            <div class="cell small-5"><?= $result["casting_time"]; ?></div>
            <div class="cell small-5"><?= $result["duration"] === "Instantaneous" ? "Instant" : $result["duration"]; ?></div>
        </div>
    </div>
    <div class="card-section ">
        <div class=" text-center tags">
            <?php
            foreach ($result["classes"] as $key => $class) {
                ?>
                <span class = "class label"><?= $class["name"]; ?></span>
                <?php
            }
            ?>
        </div>
    </div>
</div>



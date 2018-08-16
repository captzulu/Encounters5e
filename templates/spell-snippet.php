<?php
$idSpell = $result["idSpell"];
$result = $result["content"];
?>
<div class="card">
    <a  href="spell.php?id=<?= $idSpell; ?>">
        <div class="card-divider text-center">
            <h4 class="title name"><?= $result["name"]; ?></h4>
            <small><em><?= ($result["level"] == 0 ? "{$result["school"]["name"]} Cantrip" : "Lvl {$result["level"]} {$result["school"]["name"]}") . ($result["ritual"] === "yes" ? " (ritual)" : ""); ?></em></small>
        </div>
    </a>
    <div class="card-section first_section">
        <div class="grid-x text-center">
            <div class="cell small-4"><?= "<b>LvL</b>"; ?></div>
            <div class="cell small-10"><?= "<b>Casting</b>"; ?></div>
            <div class="cell small-10"><?= "<b>Duration</b>"; ?></div>
        </div>
        <div class="grid-x text-center">
            <div class="cell small-4"><?= $result["level"]; ?></div>
            <div class="cell small-10"><?= $result["casting_time"]; ?></div>
            <div class="cell small-10"><?= $result["duration"] === "Instantaneous" ? "Instant" : $result["duration"]; ?></div>
        </div>
    </div>
    <div class="card-section ">
        <div class="text-center tags classes">
            <?php
            foreach($result["classes"] as $key => $class) {
                ?>
                <span class = "label"><?= $class["name"]; ?></span>
                <?php
            }
            ?>
        </div>
    </div>
</div>



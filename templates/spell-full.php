<?php
$idMonster = $result["idSpell"];
$result = $result["content"];
?>
<div class="card fullCard">
    <div class="card-divider text-center">
        <h4 class="title name"><?= $result["name"]; ?></h4>
        <small><?= ($result["level"] == 0 ? "{$result["school"]["name"]} Cantrip" : "Lvl {$result["level"]} {$result["school"]["name"]}") . ($result["ritual"] === "yes" ? " (ritual)" : ""); ?></small>
    </div>
    <div class="card-section first_section">
        <p><b>Casting Time: </b><?= $result["casting_time"]; ?></p>
        <p><b>Range: </b><?= $result["range"]; ?></p>
        <p><b>Components: </b><?= join(", ", $result["components"]) . (!empty($result["materials"]) ? " ({$result["materials"]})" : ""); ?></p>
        <p><b>duration: </b><?= $result["concentration"] === "yes" ? "Concentration, {$result["duration"]}" : $result["duration"]; ?></p>
    </div>
    <div class="card-section">
        <?php
        printSpellDescription($result);
        ?>
    </div>
</div>



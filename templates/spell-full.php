<?php
$idMonster = $result["idSpell"];
$result = $result["content"];
?>
<div class="card fullCard">
    <div class="card-divider">
        <h4 class="title name"><?= $result["name"]; ?></h4>
    </div>
    <div class="card-section first_section">
        <?php
        $inAList = false;
        foreach ($result["desc"] as $key => $desc) {
            if ($desc[0] === "-") {
                if (!$inAList) {
                    echo "<ul>";
                    $inAList = true;
                }
                ?>
                <li><?= trim($desc, "- "); ?></li>
                <?php
                if ($inAList) {
                    echo "</ul>";
                    $inAList = false;
                }
            } else {
                ?>
                <p><?= $desc; ?></p>
                <?php
            }
        }
        ?>
    </div>
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
    <span class="resize_marker">Resize →</span>
</div>



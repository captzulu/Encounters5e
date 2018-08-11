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
        $inAList = false;
        $inAParagraph = false;
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
                //if the description line is only a word or 2 with a dot at the end, it should be boldened and italisized 
                if (count(explode(" ", $desc)) < 3 && substr($desc, -1) == ".") {
                    echo "<p><span class='italic_bold'>$desc </span>";
                    $inAParagraph = true;
                } else {
                    echo ($inAParagraph ? "" : "<p>") . "$desc</p>";
                }
            }
        }
        echo (isset($result["higher_level"]) ? "<p><span class='italic_bold'>At Higher Levels. </span>" . $result["higher_level"][0] : "");
        ?>
    </div>
</div>



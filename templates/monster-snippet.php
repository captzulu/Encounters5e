<?php
$idMonster = $result["idMonster"];
$result = $result["content"];
?>
<div class="card">
    <a  href="monster.php?id=<?= $idMonster; ?>">
        <div class="card-divider ">
            <h4 class="title name"><?= $result["name"]; ?></h4>
        </div>
    </a>
    <div class="card-section first_section">
        <div class="grid-x small-up-2 text-center stats_snippet">
            <div class="cell "><?php drawIcon("HP"); ?><?= $result["hit_points"]; ?></div>
            <div class="cell"><?php drawIcon("AC"); ?><?= $result["armor_class"]; ?></div>
        </div>
    </div>
    <div class="card-section ">
        <div class=" text-center tags">
            <span class="label">CR <span class="challenge_rating"><?= convertCR($result["challenge_rating"]); ?></span> 
                <span class="challenge_rating_sort" style="display:none;"><?= $result["challenge_rating"]; ?></span>
            </span>
            <span class="size label"><?= ucfirst($result["size"]); ?></span>
            <span class="type label"><?= ucfirst($result["type"]); ?> 
                <?php
                if(!empty($result["subtype"])) {
                    echo " (" . ucfirst($result["subtype"]) . ")";
                }
                ?>
            </span>
        </div>
    </div>

</div>



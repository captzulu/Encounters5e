<?php
$idMonster = $result["idMonster"];
$result = $result["content"];
?>
<div class="card fullCard">
    <div class="card-divider">
        <h4 class="title name"><?= $result["name"]; ?></h4>
    </div>
    <div class="card-section first_section">
        <span class="challenge_rating label">CR <?= convertCR($result["challenge_rating"]); ?></span>
        <span class="size label"><?= ucfirst($result["size"]); ?></span>
        <span class="type label"><?= ucfirst($result["type"]); ?> 
            <?php
            if (!empty($result["subtype"])) {
                echo " (" . ucfirst($result["subtype"]) . ")";
            }
            ?>
        </span>
        <span class="alignment label"><?= ucfirst($result["alignment"]); ?></span>
    </div>
    <div class="card-section">
        <span class=""><?php drawIcon("HP"); ?><?= $result["hit_points"] . " (" . $result["hit_dice"] . ")"; ?></span>
        <span class=""><?php drawIcon("AC"); ?><?= $result["armor_class"]; ?></span>
        <span class=""><?php drawIcon("Speed"); ?><?= $result["speed"]; ?></span>
    </div>
    <div class="card-section">
        <div class="grid-x small-up-6 text-center">
            <?php printAbilitiesName(); ?>
        </div>
        <div class="grid-x small-up-6 text-center">
            <?php printAbilities($result); ?>
        </div>
    </div>
    <div class="card-section">
        <?php printSaveThrow($result); ?>
        <?php printSkills($result); ?>
        <p><b>Senses : </b><?= $result["senses"]; ?></p>
        <p><b>Languages : </b><?= $result["languages"]; ?></p>
        <?php if (!empty($result["damage_vulnerabilities"])) {
            ?>
            <p><b>Damage Vulnerabilities : </b><?= $result["damage_vulnerabilities"]; ?></p>
            <?php
        }
        if (!empty($result["damage_resistances"])) {
            ?>
            <p><b>Damage Resistances : </b><?= $result["damage_resistances"]; ?></p>
            <?php
        }
        if (!empty($result["damage_vulnerabilities"])) {
            ?>
            <p><b>Damage Immunities : </b><?= $result["damage_immunities"]; ?></p>
            <?php
        }
        if (!empty($result["condition_immunities"])) {
            ?>
            <p><b>Condition Immunities : </b><?= $result["condition_immunities"]; ?></p>
            <?php
        }
        ?>
    </div>
    <?php if (!empty($result["special_abilities"])) { ?>
        <div class="card-section">
            <?php printSpecialAbilities($result); ?>
        </div>
        <?php
    }
    if (!empty($result["actions"])) {
        ?>
        <div class="card-section no_header">
            <span class="section_header">Actions</span>
            <?php printActions($result) ?>
        </div>
        <?php
    }
    if (!empty($result["legendary_actions"])) {
        ?>
        <div class="card-section no_header">
            <span class="section_header">Legendary Actions</span>
            <?php printLegActions($result) ?>
        </div>
    <?php
    }
    printConditionsDropDowns();
    ?>
</div>



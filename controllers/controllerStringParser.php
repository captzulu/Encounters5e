<?php

function boldDamageDices($string) {
    return preg_replace("(\([0-9]+d[0-9]+ (\+|\-|\—) [0-9]+\)?|\(?[0-9]*d[0-9]+\)?)", "<b>$0</b>", $string);
}

function boldDCs($string) {
    return preg_replace("(DC [0-9]+)", "<b>$0</b>", $string);
}

function boldActionType($string) {
    return preg_replace("(bonus action|reactions|reaction|actions|action)", "<b style='text-transform:capitalize;'>$0</b>", $string);
}

function boldToHit($string) {
    return preg_replace("(\+[0-9]+ to hit)", "<b style='text-transform:capitalize;'>$0</b>", $string);
}

function boldLvl($string) {
    return preg_replace("([0-9]+(th|nd|rd|rst) level)", "<b style='text-transform:capitalize;'>$0</b>", $string);
}

function dropDownConditions($string) {
    $results = CallJSON("Conditions");
    $arrayConditions = [];
    $arrayConditionsDesc = [];
    foreach ($results as $key => $condition) {
        $arrayConditions[] = "(" . strtolower($condition["name"]) . ")";
        $finalDesc = "";
        foreach ($condition["desc"] as $desc) {
            $finalDesc .= "<li>" . trim($desc, '• ') . "</li>";
        }
        $arrayConditionsDesc[] = "<a class='condition' data-open='cond_" . strtolower($condition["name"]) . "'>{$condition["name"]}</a>";
    }
    //var_dump($arrayConditions);
    return preg_replace($arrayConditions, $arrayConditionsDesc, $string);
}

function markSpells($string) {
    include "includes/connectionInfo.php";
    //first check if the string contains the word "Spellcasting" so we dont search for spells in a useless string
    $results = CallJSON("Spells");
    $arraySpells = [];
    foreach ($results as $key => $spell) {
        $arraySpells[] = "(" . strtolower($spell["name"]) . ")";
    }
    //var_dump($arrayConditions);
    return preg_replace($arraySpells, "<a class='spell'>$0</a>", $string);
}

function boldInDesc($string) {
    $string = boldDamageDices($string);
    $string = boldDCs($string);
    $string = boldActionType($string);
    $string = boldToHit($string);
    $string = boldLvl($string);
    $string = dropDownConditions($string);
    return $string;
}

function printConditionsDropDowns() {
    $results = CallJSON("Conditions");
    foreach ($results as $key => $condition) {
        $finalDesc = "";
        foreach ($condition["desc"] as $desc) {
            $finalDesc .= "<li>" . trim($desc, '• ') . "</li>";
        }
        echo "<div class='reveal' id='cond_" . strtolower($condition["name"]) . "' data-reveal>
                <h5>{$condition["name"]}</h5><ul>$finalDesc</ul>
                <button class='close-button' data-close aria-label='Close modal' type='button'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>";
    }
}

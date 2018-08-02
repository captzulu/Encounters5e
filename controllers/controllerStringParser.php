<?php

function boldDamageDices($string) {
    return preg_replace("(\([0-9]+d[0-9]+ (\+|\-|\—) [0-9]+\)?|\(?[0-9]+d[0-9]+\))", "<b>$0</b>", $string);
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

function dropDownConditions($string) {
    $results = CallJSON("Conditions");
    $arrayConditions = [];
    $arrayConditionsDesc = [];
    foreach($results as $key => $condition) {
        $arrayConditions[] = "(" . strtolower($condition["name"]) . ")";
        $finalDesc = "";
        foreach($condition["desc"] as $desc) {
            $finalDesc .= "<li>" . trim($desc, '• ') . "</li>";
        }
        $arrayConditionsDesc[] = "<a dropdownLink data-toggle='cond_" . strtolower($condition["name"]) . "'>{$condition["name"]}</a>";
    }
    $GLOBALS["counter"] = $GLOBALS["counter"] + 1;
    //var_dump($arrayConditions);
    return preg_replace($arrayConditions, $arrayConditionsDesc, $string);
}

function markSpells($string) {
    //first check if the string contains the word "Spellcasting" so we dont search for spells in a useless string
        $results = CallJSON("Spells");
        $arraySpells = [];
        foreach($results as $key => $spell) {
            $arraySpells[] = "(" . strtolower($spell["name"]) . ")";
        }
        //var_dump($arrayConditions);
        return preg_replace($arraySpells, "<a spell>$0</a>", $string);
}

function boldInDesc($string) {
    $string = boldDamageDices($string);
    $string = boldDCs($string);
    $string = boldActionType($string);
    $string = boldToHit($string);
    $string = dropDownConditions($string);
    return $string;
}

function printConditionsDropDowns() {
    $results = CallJSON("Conditions");
    foreach($results as $key => $condition) {
        $finalDesc = "";
        foreach($condition["desc"] as $desc) {
            $finalDesc .= "<li>" . trim($desc, '• ') . "</li>";
        }
        echo "<div class='dropdown-pane' id='cond_" . strtolower($condition["name"]) . "' data-dropdown data-close-on-click='true' data-position='bottom' data-alignment='center'>
                <h5>{$condition["name"]}</h5><ul>$finalDesc</ul></div>";
    }
}

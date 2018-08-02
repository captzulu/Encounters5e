<?php

$counter = 0;

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

function boldConditions($string) {
    $results = CallJSON("Conditions");
    $arrayConditions = [];
    $arrayConditionsDesc = [];
    foreach ($results as $key => $condition) {
        $arrayConditions[] = "(" . strtolower($condition["name"]) . ")";
        $finalDesc = "";
        foreach ($condition["desc"] as $desc) {
            $finalDesc.="<li>" . trim($desc, '• ') . "</li>";
        }
        $arrayConditionsDesc[] = "<a data-toggle='cond_" . strtolower($condition["name"]) . "_{$GLOBALS["counter"]}'>{$condition["name"]}</a>
            <div class='dropdown-pane' id='cond_" . strtolower($condition["name"]) . "_{$GLOBALS["counter"]}' data-dropdown data-auto-focus='true'>
                <h5>{$condition["name"]}</h5><ul>$finalDesc</ul></div>";
    }
    $GLOBALS["counter"] = $GLOBALS["counter"] + 1;
    //var_dump($arrayConditions);
    return preg_replace($arrayConditions, $arrayConditionsDesc, $string);
}

function boldInDesc($string) {
    $string = boldDamageDices($string);
    $string = boldDCs($string);
    $string = boldActionType($string);
    $string = boldToHit($string);
    $string = boldConditions($string);
    return $string;
}

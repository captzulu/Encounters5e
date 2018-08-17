<?php

// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value

function CallAPI($method, $url, $data = false) {
    $curl = curl_init();

    switch($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

// Optional Authentication:
//curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

function CallJSON($categorie) {
    $results = file_get_contents("5e-database/5e-SRD-$categorie.json");
    $results = json_decode($results, true);
    return $results;
}

function getTable($table, $id = null, $orderBy = null) {
    include "includes/connectionInfo.php";
    $query = "Select * from $table " . (!empty($id) ? "where id$table=:id " : "") . (!empty($orderBy) ? "Order by $orderBy " : "");
    //var_dump($query);
    $pdo = $db->prepare($query);
    $params = !empty($id) ? [':id' => $id] : [];
    $pdo->execute($params);
    return $pdo->fetchAll(PDO::FETCH_ASSOC);
}

function drawIcon($iconToDraw) {
    switch($iconToDraw) {
        case "HP":
            echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M414.9 24C361.8 24 312 65.7 288 89.3 264 65.7 214.2 24 161.1 24 70.3 
                24 16 76.9 16 165.5c0 72.6 66.8 133.3 69.2 135.4l187 180.8c8.8 8.5 22.8 8.5 31.6 0l186.7-180.2c2.7-2.7 69.5-63.5 69.5-136C560 76.9 505.7 24 414.9 24z"
                style="fill: #FF4136;"></path></svg>';
            break;
        case "AC":
            echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" ><path d="M466.5 83.7l-192-80a48.15 48.15 0 0 0-36.9 0l-192 80C27.7 91.1 
                16 108.6 16 128c0 198.5 114.5 335.7 221.5 380.3 11.8 4.9 25.1 4.9 36.9 0C360.1 472.6 496 349.3 496 128c0-19.4-11.7-36.9-29.5-44.3z" style="fill: #19A974;">
                </path></svg>';
            break;
        case "Speed":
            echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256
                8zm-28.9 143.6l75.5 72.4H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h182.6l-75.5 72.4c-9.7 9.3-9.9 24.8-.4 34.3l11 10.9c9.4 9.4 24.6 9.4 33.9 0L404.3
                273c9.4-9.4 9.4-24.6 0-33.9L271.6 106.3c-9.4-9.4-24.6-9.4-33.9 0l-11 10.9c-9.5 9.6-9.3 25.1.4 34.4z" style="fill: #408BC9;"></path></svg>';
            break;
    }
}

function printAbilitiesName() {
    include 'extraData/abilityNames.php';
    foreach($arrayAbilities as $shorthand => $text) {
        ?>
        <div class="cell statname big"><?= $shorthand; ?></div>
        <?php
    }
}

function printAbilities($monsterStats) {
    require_once 'extraData/abilityScoresMods.php';
    include 'extraData/abilityNames.php';
    foreach($arrayAbilities as $text) {
        ?>
        <div class="cell"><?= "<span class='fullStat'>{$monsterStats[$text]}</span> (" . getModifier($monsterStats[$text]) . ")"; ?></div>
        <?php
    }
}

function printSaveThrow($monsterStats) {
    include 'extraData/abilityNames.php';
    $arraySaves = [];
    foreach($arrayAbilities as $shorthand => $text) {
        $val = $monsterStats[$text . "_save"];
        if(!empty($val)) {
            $arraySaves[$shorthand] = $val;
        }
    }

    if(!empty($arraySaves)) {
        $string = "<p><b>Saves : </b>";
        foreach($arraySaves as $shorthand => $val) {
            $string .= "<span class='statname'>$shorthand</span>(+$val), ";
        }
        echo trim($string, ", ") . "</p>";
    }
}

function printSkills($monsterStats) {
    $results = CallJSON("Skills");

    foreach($results as $key => $result) {
        $val = $monsterStats[strtolower($result["name"])];
        if(!empty($val)) {
            $arraySaves[$result["name"]] = $val;
        }
    }

    if(!empty($arraySaves)) {
        $string = "<p><b>Skills : </b>";
        foreach($arraySaves as $skillName => $val) {
            $string .= "$skillName (+$val), ";
        }
        echo trim($string, ", ") . "</p>";
    }
}

function printSpecialAbilities($monsterStats) {
    if(!empty($monsterStats["special_abilities"])) {
        foreach($monsterStats["special_abilities"] as $key => $ability) {
            if(strpos($ability["name"], "Spellcasting") !== false) {
                $ability["desc"] = markSpells($ability["desc"]);
            }
            ?>
            <div class="ability"><b><?= $ability["name"] ?></b> <?= boldInDesc($ability["desc"]) ?></div>
            <?php
        }
    }
}

function printActions($monsterStats) {
    if(!empty($monsterStats["actions"])) {
        foreach($monsterStats["actions"] as $key => $ability) {
            ?>
            <div class="action"><b><?= $ability["name"] ?></b> <?= boldInDesc($ability["desc"]) ?></div>
            <?php
        }
    }
}

function printLegActions($monsterStats) {
    if(!empty($monsterStats["legendary_actions"])) {
        foreach($monsterStats["legendary_actions"] as $key => $ability) {
            ?>
            <div class="action">
                <b><?= $ability["name"] ?></b> <?= boldInDesc($ability["desc"]) ?>
            </div> 
            <?php
        }
    }
}

function printSpellDescription($spellText) {
    $inAList = false;
    $inAParagraph = false;
    foreach($spellText["desc"] as $key => $desc) {
        if($desc[0] === "-") {
            if(!$inAList) {
                echo "<ul>";
                $inAList = true;
            }
            ?>
            <li><?= boldInDesc(trim($desc, "- ")); ?></li>
            <?php
            if($inAList) {
                echo "</ul>";
                $inAList = false;
            }
        } else {
            //if the description line is only a word or 2 with a dot at the end, it should be boldened and italisized 
            if(count(explode(" ", $desc)) < 3 && substr($desc, -1) == ".") {
                echo "<p><span class='italic_bold'>" . boldInDesc($desc) . " </span>";
                $inAParagraph = true;
            } else {
                echo ($inAParagraph ? "" : "<p>") . boldInDesc($desc) . "</p>";
            }
        }
    }
    echo (isset($spellText["higher_level"]) ? "<p><span class='italic_bold'>At Higher Levels. </span>" . boldInDesc($spellText["higher_level"][0]) : "");
}

function decimalToFraction($decimal) {
    if($decimal < 0 || !is_numeric($decimal)) {
        // Negative digits need to be passed in as positive numbers
        // and prefixed as negative once the response is imploded.
        return false;
    }
    if($decimal == 0) {
        return [0, 0];
    }

    $tolerance = 1.e-4;

    $numerator = 1;
    $h2 = 0;
    $denominator = 0;
    $k2 = 1;
    $b = 1 / $decimal;
    do {
        $b = 1 / $b;
        $a = floor($b);
        $aux = $numerator;
        $numerator = $a * $numerator + $h2;
        $h2 = $aux;
        $aux = $denominator;
        $denominator = $a * $denominator + $k2;
        $k2 = $aux;
        $b = $b - $a;
    } while(abs($decimal - $numerator / $denominator) > $decimal * $tolerance);

    return $numerator . "/" . $denominator;
}

function convertCR($CRVal) {
    if($CRVal < 1 && $CRVal > 0) {
        return decimalToFraction($CRVal);
    }
    return $CRVal;
}

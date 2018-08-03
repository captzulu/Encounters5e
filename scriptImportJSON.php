<?php

include "includes/connectionInfo.php";
include 'controllers/controllerAPI.php';
$spells = CallJSON("Monsters");
$JSON = file_get_contents("5e-database/5e-SRD-Monsters.json");
$query = "Insert into monsters Values ";
foreach ($spells as $key => $spell) {
//    foreach ($spell["special_abilities"] as $key => $value) {
//        $spell["special_abilities"][$key] = preg_replace("2022", "-", preg_replace(["\\n", "\\u"], " ", $value));
//    }
    //var_dump(json_encode($spell, JSON_UNESCAPED_UNICODE));
    $query.='(null,"' . addSlashes(json_encode($spell, JSON_UNESCAPED_UNICODE)) . '","' . $spell["name"] . '","' . $spell["type"] . '",' . $spell["challenge_rating"] . '),';
}
$query = trim($query, ",");
var_dump($query);
$db->exec($query);


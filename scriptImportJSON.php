<?php

include "includes/connectionInfo.php";
include 'controllers/controllerAPI.php';
$spells = CallJSON("Spells");
//$JSON = file_get_contents("5e-database/5e-SRD-Spells.json");
$query = "Insert into spell Values ";
foreach ($spells as $key => $spell) {
//    foreach ($spell["special_abilities"] as $key => $value) {
//        $spell["special_abilities"][$key] = preg_replace("2022", "-", preg_replace(["\\n", "\\u"], " ", $value));
//    }
    //var_dump(json_encode($spell, JSON_UNESCAPED_UNICODE));
    $query .= '(null,"' . addSlashes(json_encode($spell, JSON_UNESCAPED_UNICODE)) . '","' . $spell["name"] . '","' . $spell["level"] . '"),';
}
$query = trim($query, ",");
//var_dump($query);
$db->exec($query);


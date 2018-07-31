<?php
$bd = new PDO('mysql:host=192.168.1.31;dbname=PostalCodes;charset=utf8', "root", "4FdL,1fE");
$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::CASE_NATURAL);

$file = "../SassUniversal/database/database.php";
if(!file_exists($file)) {
    $file = "../" . $file;
}
require_once $file;

$file = "../SassUniversal/database/defaultConnection.php";
require $file;
$options["dbname"] = 'employe';
if($_SERVER["SERVER_NAME"] === "www.contrastlighting.com") {
    $options["host"] = "192.168.1.18";
}
$db = new database($options);
$settingArray = (object) [
            'httpsOnly' => $_SERVER["SERVER_NAME"] == "eclweb2.contraste.local" ? false : true,
            "https" => ["toBeInitialised"],
];
$settingArray->https = $settingArray->httpsOnly ? "https" : "http";

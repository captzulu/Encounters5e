<?php

$options = [PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode for "real" prepared statements
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

$db = new PDO("mysql:host=localhost;dbname=5eData;charset=utf8", "root", "captzulu55", $options);



<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?= isset($PageTitle) ? $PageTitle : "Encounter" ?></title>
        <?= isset($PageDesc) ? "<meta name='description' content='$PageDesc'>" : ""; ?>
        <link rel = "stylesheet" href = "css/app.css" />
        <?php
        if(function_exists('moreCSS')) {
            moreCSS();
        }
        ?>
        <script src="node_modules/jquery/dist/jquery.js"></script>
        <script src="node_modules/what-input/dist/what-input.js"></script>
        <script src="node_modules/foundation-sites/dist/js/foundation.js"></script>
    </head>
    <body>

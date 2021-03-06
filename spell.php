<?php

function moreCSS() {
    ?>
    <link rel="stylesheet" href="css/fullCards.css" />
    <?php
}

include 'controllers/controllerAPI.php';
include_once 'includes/header.php';
require 'controllers/controllerStringParser.php';
$results = getTable("spell", $_GET["id"]);
//var_dump($results);
?>
<div class="grid-container fluid" style="margin:3rem 0;">
    <div class="grid-x grid-margin-x small-up-1 medium-up-2 xlarge-up-3 list">
        <?php
        foreach($results as $key => $result) {
            $newContent = json_decode(stripslashes($result["content"]), true);
            $result["content"] = !empty($newContent) ? $newContent : json_decode($result["content"], true);
            //var_dump($result);
            ?>
            <div class="cell singleFullCard" style="margin: auto;">
                <?php require "templates/spell-full.php"; ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>


<script >
    $(function () {

    });

</script>
<?php
include_once('includes/footer.php');



<?php

function moreCSS() {
    ?>
    <link rel="stylesheet" href="css/fullCards.css" />
    <?php
}

include 'controllers/controllerAPI.php';
include_once 'includes/header.php';
require 'controllers/controllerStringParser.php';
$results = getTable("monster", $_GET["id"]);
printConditionsDropDowns();
?>
<div class="grid-container fluid" style="margin:3rem 0;">
    <div class="grid-x grid-margin-x small-up-2 medium-up-3 large-up-4 list">
        <?php
        foreach ($results as $key => $result) {
            $result["content"] = json_decode(stripslashes($result["content"]), true);
            ?>
            <div class="cell singleFullCard" style="margin: auto;">
                <?php require "templates/monster-full.php"; ?>
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



<?php

function moreCSS() {
    ?>
    <link rel="stylesheet" href="css/fullCards.css" />
    <?php
}

function moreJS() {
    ?>
    <script src="js/focusRightAnchor.js" type="text/javascript"></script>
    <?php
}

include 'controllers/controllerAPI.php';
include_once 'includes/header.php';
require 'controllers/controllerStringParser.php';
$results = getTable("monster", $_GET["id"]);
?>
<div class="grid-container fluid" style="margin:3rem 0;">
    <div class="grid-x grid-margin-x small-up-1 medium-up-2 xlarge-up-3 list">
        <?php
        foreach ($results as $key => $result) {
            $result["content"] = json_decode(stripslashes($result["content"]), true);
            ?>
            <div class="cell singleFullCard" style="margin: auto;">
                <?php
                require "templates/monster-full.php";
                ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>


<script >

</script>
<?php
include_once('includes/footer.php');



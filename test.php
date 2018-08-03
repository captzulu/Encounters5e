<?php

function moreCSS() {
    ?>
    <link rel="stylesheet" href="css/fullCards.css" />
    <?php
}

include 'controllers/controllerAPI.php';
include_once 'includes/header.php';
require 'controllers/controllerStringParser.php';
$results = getTable("monsters");
printConditionsDropDowns();
//var_dump($results);
?>
<div class="grid-container fluid" style="margin-top: 100px;">
    <div id="monsterList">
        <input type="text" class="search" placeholder="Filter by Name, CR, Size or Type"/>
        <ul class="pagination"></ul>
        <div class="grid-x grid-margin-x small-up-2 medium-up-4 large-up-5 list">
            <?php
            foreach ($results as $key => $result) {
                $result["content"] = json_decode(stripslashes($result["content"]), true);
                ?>
                <div class="cell">
                    <?php require "templates/monster-full.php"; ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>


<script src="node_modules/list.js/dist/list.js"></script>
<script >
    $(function () {
        var options = {
            valueNames: ['name', 'challenge_rating', 'size', 'type'],
            page: 10,
            pagination: true
        };

        var monsterList = new List('monsterList', options);
        monsterList.on("updated", function () {
            Foundation.reInit($(".dropdownLink"));
        });

    });

</script>
<?php
include_once('includes/footer.php');

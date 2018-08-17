<?php

function moreCSS() {
    ?>
    <link rel="stylesheet" href="css/snippet.css" />
    <link rel="stylesheet" href="css/filterPage.css" />
    <?php
}

include 'controllers/controllerAPI.php';

include_once 'includes/header.php';
$results = getTable("spell", null, "level, name");
//var_dump($results);
?>
<div class="grid-container fluid" >
    <div id="spellList">
        <div class="searchDiv grid-x grid-margin-x">
            <div class="cell medium-12">
                <input type="text" class="search" placeholder="Filter by Name, Casting Time, Duration or Class"/>
                <ul class="pagination"></ul>
            </div>
            <div class="cell medium-12">
                <label class='slider_label'>Level Filter</label>
                <div class="slider" data-slider data-double-sided='true' data-initial-start="0" data-initial-end="9" data-start="0" data-end="9" data-changed-delay='250'>
                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="lowVal"><input id='lowVal' readonly="" /></span>
                    <span class="slider-fill" data-slider-fill></span>
                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="highVal"><input id='highVal' readonly=""/></span>
                    <input type="hidden">
                    <input type="hidden">
                </div>
            </div>
            <div class="cell medium-24">
                <span class="sort label" data-sort="name">Name</span>
                <span class="sort label" data-sort="level">Level</span>
            </div>
        </div>
        <div class="grid-x grid-margin-x small-up-1 small_med-up-2 medium-up-3 large-up-4 xlarge-up-5 xxlarge-up-6 list">
            <?php
            foreach($results as $key => $result) {
                $newContent = json_decode(stripslashes($result["content"]), true);
                $result["content"] = !empty($newContent) ? $newContent : json_decode($result["content"], true);
                ?>
                <div class="cell">
                    <?php require "templates/spell-snippet.php"; ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>


<script src="node_modules/list.js/dist/list.js"></script>
<script src="js/listFunctions.js" type="text/javascript"></script>
<script >
    $(function () {
        var spellList = listJS.init("spellList", ['name', 'classes', 'duration', 'level', 'casting']);
        listJS.listeners($(".slider"), spellList, "spell");
        //makes it so we see the arrow pointing up
        $("[data-sort='level']").click();
    });
</script>
<?php
include_once('includes/footer.php');

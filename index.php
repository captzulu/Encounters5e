<?php

function moreCSS() {
    ?>
    <link rel="stylesheet" href="css/snippet.css" />
    <link rel="stylesheet" href="css/filterPage.css" />
    <?php
}

include 'controllers/controllerAPI.php';

include_once 'includes/header.php';
$results = getTable("monster");
//var_dump($results);
?>
<div class="grid-container fluid" >
    <div id="monsterList">
        <div class="searchDiv grid-x grid-margin-x">
            <div class="cell medium-12">
                <input type="text" class="search" placeholder="Filter by Name, Size or Type"/>
                <ul class="pagination"></ul>
            </div>
            <div class="cell medium-12">
                <label class='slider_label'>Challenge Rating Filter</label>
                <div class="slider" data-slider data-double-sided='true' data-initial-start="0" data-initial-end="18" data-start="0" data-end="18" data-changed-delay='250'>
                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="lowCR"><input id='lowCR' readonly="" /></span>
                    <span class="slider-fill" data-slider-fill></span>
                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="highCR"><input id='highCR' readonly=""/></span>
                    <input type="hidden">
                    <input type="hidden">
                </div>
            </div>
            <div class="cell medium-24">
                <span class="sort label" data-sort="name">Name</span>
                <span class="sort label" data-sort="challenge_rating_sort">CR</span>
                <span class="sort label" data-sort="size">Size</span>
                <span class="sort label" data-sort="type">Type</span>
            </div>
        </div>
        <div class="grid-x grid-margin-x small-up-1 small_med-up-2 medium-up-3 large-up-4 xlarge-up-5 xxlarge-up-6 list">
            <?php
            foreach($results as $key => $result) {
                $result["content"] = json_decode(stripslashes($result["content"]), true);
                ?>
                <div class="cell">
                    <?php require "templates/monster-snippet.php"; ?>
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
        var monsterList = listJS.init("monsterList", ['name', 'challenge_rating', 'challenge_rating_sort', 'size', 'type']);
        listJS.listeners($(".slider"), monsterList);
        //makes it so we see the arrow pointing up
        $("[data-sort='name']").click();
    });
</script>
<?php
include_once('includes/footer.php');

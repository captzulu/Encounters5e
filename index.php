<?php

function moreCSS() {
    ?>
    <link rel="stylesheet" href="css/snippet.css" />
    <?php
}

include 'controllers/controllerAPI.php';

include_once 'includes/header.php';
$results = getTable("monster");
//var_dump($results);
?>
<div class="grid-container fluid" >
    <div id="monsterList">
        <div class="searchDiv">
            <input type="text" class="search" placeholder="Filter by Name, CR, Size or Type"/>
            <ul class="pagination"></ul>
        </div>
        <div class="grid-x grid-margin-x small-up-1 small_med-up-2 medium-up-3 xlarge-up-5 xxlarge-up-6 list">
            <?php
            foreach ($results as $key => $result) {
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
<script >
    $(function () {
        var options = {
            valueNames: ['name', 'challenge_rating', 'size', 'type'],
            page: 25,
            pagination: [{paginationClass: "pagination", outerWindow: 1, innerWindow: 1}, ]
        };

        var monsterList = new List('monsterList', options);
    });

</script>
<?php
include_once('includes/footer.php');

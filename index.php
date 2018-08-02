<?php

function moreCSS() {
    ?>
    <link rel="stylesheet" href="css/snippet.css" />
    <?php
}

include 'controllers/controllerAPI.php';

include_once 'includes/header.php';
$results = CallJSON("Monsters");
//var_dump($results);
?>
<div class="grid-container fluid" style="margin-top: 100px;">
    <div id="monsterList">
        <input type="text" class="search" placeholder="Filter by Name, CR, Size or Type"/>
        <ul class="pagination"></ul>
        <div class="grid-x grid-margin-x small-up-2 medium-up-4 large-up-6 list">
            <?php
            foreach($results as $key => $result) {
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

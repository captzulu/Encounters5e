<?php
include 'controllers/controllerAPI.php';
include_once 'includes/header.php';
$results = CallJSON("Monsters");
//var_dump($results);
?>
<div id="monsterList">
    <input type="text" class="search" />
    <ul class="pagination"></ul>
    <div class="grid-x grid-margin-x small-up-2 medium-up-4 large-up-5 list">

        <?php
        foreach($results as $key => $result) {
            ?>
            <div class="cell">
                <?php require "templates/monster-full.php"; ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>


<script src="node_modules/list.js/dist/list.js"></script>
<script >
    var options = {
        valueNames: ['name', 'challenge_rating', 'size', 'type'],
        page: 12,
        pagination: true
    };

    var monsterList = new List('monsterList', options);
</script>
<?php
include_once('includes/footer.php');

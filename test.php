<?php
include 'controllers/controllerAPI.php';
include_once 'includes/header.php';
require 'controllers/controllerStringParser.php';
$results = CallJSON("Monsters");
//var_dump($results);
?>
<div class="grid-container fluid" style="margin-top: 100px;">
    <div id="monsterList">
        <input type="text" class="search" placeholder="Filter by Name, CR, Size or Type"/>
        <ul class="pagination"></ul>
        <div class="grid-x grid-margin-x small-up-2 medium-up-4 large-up-5 list">

            <?php
            foreach ($results as $key => $result) {
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
            page: 12,
            pagination: true
        };

        var monsterList = new List('monsterList', options);
        function bob() {
            Foundation.reInit('DropdownMenu');
        }
        monsterList.on("updated", bob);

    });

</script>
<?php
include_once('includes/footer.php');

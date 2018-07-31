<?php
include 'controllers/controllerAPI.php';
include_once 'includes/header.php';
$results = CallAPI("GET", "www.dnd5eapi.co/api/spells");
$results = json_decode($results);
//var_dump($results);
?>

<div class="grid-x grid-margin-x small-up-2 medium-up-4 large-up-6">
    <?php
    foreach($results->results as $key => $result) {
        ?>
        <div class="cell ">
            <div class="card spell">
                <div class="card-divider">
                    <h4><?= $result->name; ?></h4>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>



<?php
include_once('includes/footer.php');

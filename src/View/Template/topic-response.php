<?php

require_once(__DIR__.'/../../Model/responseModel.php');

if (isset($response)) {
    ?>
        <div class="topic-response">
            <h2> <?= $response->id ?> </h2>
            <h2> <?=  $response->owner->username ?> </h2>
            <p> <?= $response->content ?> </p>
        </div>
    <?php
}

?>

<?php

require_once(__DIR__.'/../../Model/topicModel.php');

if (isset($topic)) {
    ?>
        <div class="topic">
            <h2> <?= $topic->id ?> </h2>
            <h2> <?=  $topic->title ?> </h2>
            <p> <?= $topic->content ?> </p>
        </div>
    <?php
}

?>

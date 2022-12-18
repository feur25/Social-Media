<?php

require_once __DIR__.'/../../../Model/topicModel.php';

if ( isset($topic) && $topic != null ) {
    ?>
    <a class="topic-preview" href="/topic/?id=<?= $topic->id ?>">
        <img src="<?= '/public/images/topic/'. $topic->id . '/header.jpg' ?>"/>
        <h2> <?= $topic->id ?> </h2>
        <h2> <?= $topic->title ?> </h2>
        <p> <?= $topic->content ?> </p>
    </a>
    <?php
}

?>

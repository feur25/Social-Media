<?php

require_once __DIR__.'/../../../../Model/topicResponseModel.php';

if ( isset($response) && $response != null ) {
    ?>
        <div class="topic-response">
            <?php 
            $user = $response->owner;
            require __DIR__.'/../../user/preview.php'; 
            ?>
            <p> <?= $response->content ?> </p>
            <?php
                if ( isset($_SESSION['userId']) && $_SESSION['userId'] == $response->owner->id ) {
                    ?>
                        <a class="link" href="/topic/edit-response?id=<?= $response->id ?>&content=<?= $response->content ?>">Edit</a>
                        <a class="link" href="/topic/delete-response?id=<?= $response->id ?>">Delete</a>
                    <?php
                }
            ?>
        </div>
    <?php
}

?>

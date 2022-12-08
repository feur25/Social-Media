<?php

require_once(__DIR__.'/../../../../Model/topicResponseModel.php');

if (isset($response)) {
    ?>
        <div class="topic-response">
            <h2> <?= $response->id ?> </h2>
            <h2> <?=  $response->owner->username ?> </h2>
            <p> <?= $response->content ?> </p>
            <?php
                if ( isset($_SESSION['userId']) && $_SESSION['userId'] == $response->owner->id ) {
                    ?>
                        <a href="/topic/edit-response?id=<?= $response->id ?>&content=<?= $response->content ?>">Edit</a>
                        <a href="/topic/delete-response?id=<?= $response->id ?>">Delete</a>
                    <?php
                }
            ?>
        </div>
    <?php
}

?>

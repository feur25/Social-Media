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
                        <div class="topic-options">
                            <a class="link-small" href="/topic/edit-response?id=<?= $response->id ?>&content=<?= $response->content ?>"><?= translate("edit") ?></a>
                            <a class="link-small" href="/topic/delete-response?id=<?= $response->id ?>"><?= translate("delete") ?></a>
                        </div>
                    <?php
                }
            ?>
        </div>
    <?php
}

?>

<?php

require_once __DIR__."/../util/translate.php";

if ( isset($topic) && $topic != null ) {
    
    require_once __DIR__.'/../Model/topicModel.php';

    ?>
    <div class="topic">

        <?php
        $user = $topic->owner;
        require __DIR__."/Template/user/preview.php";
        ?>

        <h2><?= $topic->id ?></h2>
        <h2><?= $topic->title ?></h2>
        <h2>
            <?php
            switch($topic->mood) {
                case 0:
                    echo "&#128512;";
                    break;
                case 1:
                    echo "&#128542;";
                    break;
                case 2:
                    echo "&#129300;";
                    break;
                case 3:
                    echo "&#128577;";
                    break;
            }
            ?>
        </h2>
        <p><?= $topic->content ?></p>

        <?php
        if ( isset($_SESSION['userId']) && $_SESSION['userId'] == $topic->owner->id ) {
            ?>
            <a href="/topic/edit/?id=<?= $topic->id ?>&title=<?= $topic->title ?>&content=<?= $topic->content ?>&mood=<?= $topic->mood ?>" class="link"><?= translate("edit") ?></a>
            <a href="/topic/delete/?id=<?= $topic->id ?>" class="link"><?= translate("delete") ?></a>
            <?php
        }
        ?>
        
    </div>
    <?php

    require __DIR__."/Template/topic/response/form.php";

    if (isset($responses)) {
        foreach ($responses as $response) {
            require __DIR__."/Template/topic/response/topic-response.php";
        }
    }


} else {
    require __DIR__."/Template/topic/form.php";
    echo '<div id="topics-list"></div>';
}


?>
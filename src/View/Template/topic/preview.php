<?php

require_once __DIR__.'/../../../Model/topicModel.php';

if ( isset($topic) && $topic != null ) {
    ?>
    <a class="topic-preview" href="/topic/?id=<?= $topic->id ?>">
        <?php
        if ( is_file( __DIR__."/../../../../public/images/topic/".$topic->id."/header.jpg" ) ) {
            ?>
            <img class="topic-header" src="<?= '/public/images/topic/'.$topic->id.'/header.jpg' ?>"/>
            <div class="vertical-line"></div>
            <?php
        }
        ?>
    
        <div class="topic-info">
            <h2 class="topic-title"><?= $topic->title ?></h2>
            <p class="topic-content"><?= $topic->content ?></p>
        </div>
        <span class="topic-mood">
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
        </span>
    </a>
    <?php
}

?>

<?php

require_once __DIR__."/../util/translate.php";

if ( isset($topic) && $topic != null ) {
    
    require_once __DIR__.'/../Model/topicModel.php';
    require_once __DIR__.'/../Model/topicReactionModel.php';

    ?>
    <div class="topic">

        <script src="/public/scripts/topic-reaction.js" type="text/javascript" defer></script>

        <?php
        $user = $topic->owner;
        require __DIR__."/Template/user/preview.php";
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

        <span class="topic-reactions">
            <?php
            $topicReactions = TopicReactionRepository::getSortedReactions($topic->id);
            ?>
            <span id="thumbs-up-reaction" class="topic-reaction">
                <span>&#128077;</span>
                <span class="topic-reaction-count"><?= count($topicReactions->thumbsUp) ?></span>
                <?php
                if ( count($topicReactions->thumbsUp) > 0) {
                    ?>
                    <div class="topic-reaction-list">
                        <?php
                        foreach ($topicReactions->thumbsUp as $reaction) {
                            ?>
                            <span>
                                <?= $reaction->sender->username ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </span>
            <span id="thumbs-down-reaction" class="topic-reaction">
                <span>&#128078;</span>
                <span class="topic-reaction-count"><?= count($topicReactions->thumbsDown) ?></span>
                <?php
                if ( count($topicReactions->thumbsDown) > 0) {
                    ?>
                    <div class="topic-reaction-list">
                        <?php
                        foreach ($topicReactions->thumbsDown as $reaction) {
                            ?>
                            <span>
                                <?= $reaction->sender->username ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </span>
            <span id="laughing-reaction" class="topic-reaction">
                <span>&#128514;</span>
                <span class="topic-reaction-count"><?= count($topicReactions->laughing) ?></span>
                <?php
                if ( count($topicReactions->laughing) > 0) {
                    ?>
                    <div class="topic-reaction-list">
                        <?php
                        foreach ($topicReactions->laughing as $reaction) {
                            ?>
                            <span>
                                <?= $reaction->sender->username ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </span>
            <span id="heart-reaction" class="topic-reaction">
                <span>&#128151;</span>
                <span class="topic-reaction-count"><?= count($topicReactions->heart) ?></span>
                <?php
                if ( count($topicReactions->heart) > 0) {
                    ?>
                    <div class="topic-reaction-list">
                        <?php
                        foreach ($topicReactions->heart as $reaction) {
                            ?>
                            <span>
                                <?= $reaction->sender->username ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </span>
            <span id="sad-reaction" class="topic-reaction">
                <span>&#128549;</span>
                <span class="topic-reaction-count"><?= count($topicReactions->sad) ?></span>
                <?php
                if ( count($topicReactions->sad) > 0) {
                    ?>
                    <div class="topic-reaction-list">
                        <?php
                        foreach ($topicReactions->sad as $reaction) {
                            ?>
                            <span>
                                <?= $reaction->sender->username ?>
                            </span>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </span>
        </span>

        <?php
        if ( isset($_SESSION['userId']) && $_SESSION['userId'] == $topic->owner->id ) {
            ?>
            <div class="topic-options">
                <a class="link-small" href="/topic/edit/?id=<?= $topic->id ?>&title=<?= $topic->title ?>&content=<?= $topic->content ?>&mood=<?= $topic->mood ?>"><?= translate("edit") ?></a>
                <a class="link-small" href="/topic/delete/?id=<?= $topic->id ?>"><?= translate("delete") ?></a>
            </div>
            <?php
        }
        ?>
        
    </div>

    <h1><?= translate("create_response") ?></h1>
    <?php
    require __DIR__."/Template/topic/response/form.php";

    if (isset($responses)) {
        foreach ($responses as $response) {
            require __DIR__."/Template/topic/response/topic-response.php";
        }
    }


} else {
    ?>
    <h1><?= translate("create_topic") ?></h1> 
    <?php
    require __DIR__."/Template/topic/form.php";
    echo '<div id="topics-list"></div>';
}


?>
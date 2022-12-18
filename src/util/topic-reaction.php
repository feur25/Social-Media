<?php


function get_topic_reaction(int $topicId, int $userId) : int {

    require_once __DIR__."/../Model/TopicReactionModel.php";

    $reaction = TopicReactionRepository::getReactionOnTopicFromSender($topicId, $userId);

    return $reaction == null ? -1 : $reaction->type;
}

function set_topic_reaction(int $topicId, int $userId, int $reaction) {

    require_once __DIR__."/../Model/TopicReactionModel.php";

    TopicReactionRepository::setReactionOnTopicFromSender($topicId, $userId, $reaction);
}

function remove_topic_reaction(int $topicId, int $userId) {

    require_once __DIR__."/../Model/TopicReactionModel.php";

    TopicReactionRepository::removeReactionOnTopicFromSender($topicId, $userId);
}




if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['func']) ) {
    $reaction_func = $_POST['func'];

    if ( $reaction_func == 'setReaction') {
        echo set_topic_reaction( $_POST['topicId'], $_SESSION['userId'], $_POST['reaction'] );
    } else if ( $reaction_func == 'removeReaction') {
        echo remove_topic_reaction( $_POST['topicId'], $_SESSION['userId'] );
    }

} else if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {

    echo get_topic_reaction( $_GET['topicId'], $_SESSION['userId'] );

}

?>

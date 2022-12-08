<?php 

require_once __DIR__.'/../src/Controller/topicController.php';

if ( isset($_SESSION['userId']) && isset($_GET['id']) ) {
    $topicController = new TopicController();
    $topic = $topicController->getTopicById($_GET['id']);

    if ( $topic->owner->id == $_SESSION['userId'] ) {
        $topicController->deleteTopic($_GET['id']);
    }
}

header('Location: /topic');

?>
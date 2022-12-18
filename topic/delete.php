<?php 

require_once __DIR__.'/../src/Controller/topicController.php';

if ( session_status() != PHP_SESSION_ACTIVE ){
    session_start();
}

if ( isset($_SESSION['userId']) && isset($_GET['id']) ) {
    $topic = TopicRepository::getTopicById($_GET['id']);

    if ( $topic->owner->id == $_SESSION['userId'] ) {
        TopicRepository::deleteTopic($_GET['id']);
    }
}

header('Location: /topic');

?>
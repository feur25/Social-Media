<?php 

require_once __DIR__.'/../src/Controller/topicController.php';

if ( isset($_SESSION['userId']) && isset($_GET['id']) ) {
    $topic = TopicRepository::getTopicById($_GET['id']);

    if ( true ) {
        TopicRepository::deleteTopic($_GET['id']);
        echo "grosse salope";
    }
}

// header('Location: /topic');

?>
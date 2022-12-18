<?php 

require_once __DIR__.'/../src/Controller/topicResponseController.php';

if ( isset($_SESSION['userId']) && isset($_GET['id']) ) {
    $response = TopicResponseRepository::getResponseById($_GET['id']);
    echo $_GET['id'];

    if ( $response->owner->id == $_SESSION['userId'] ) {
        TopicResponseRepository::deleteResponse($_GET['id']);
    }

    var_dump($response);
}

// header('Location: /topic/?id='.$response->topic->id);

?>
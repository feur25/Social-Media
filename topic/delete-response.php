<?php 

require_once __DIR__.'/../src/Controller/topicResponseController.php';

if ( isset($_SESSION['userId']) && isset($_GET['id']) ) {
    $topicResponseController = new TopicResponseController();
    $response = $topicResponseController->getResponseById($_GET['id']);

    if ( $response->owner->id == $_SESSION['userId'] ) {
        $topicResponseController->deleteResponse($_GET['id']);
    }
}

header('Location: ../topic/?id='.$response->topic->id);

?>
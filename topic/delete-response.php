<?php 

require_once __DIR__.'/../src/Controller/topicResponseController.php';

if ( session_status() != PHP_SESSION_ACTIVE ){
    session_start();
}

if ( isset($_SESSION['userId']) && isset($_GET['id']) ) {
    $topic = TopicResponseRepository::getResponseById($_GET['id']);

    if ( $topic->owner->id == $_SESSION['userId'] ) {
        TopicResponseRepository::deleteResponse($_GET['id']);
    }
}

header('Location: '.$_SERVER['HTTP_REFERER']);

?>
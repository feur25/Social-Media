<?php

require_once __DIR__.'/../Model/topicModel.php';
require_once __DIR__.'/../Model/topicResponseModel.php';

class TopicResponseController {


    public static function edit_page() {

        if ( session_status() != PHP_SESSION_ACTIVE ){
            session_start();
        }

        $response = TopicResponseRepository::getResponseById($_GET['id']);

        if ( isset($_POST['response-content']) ) {

            if ( !isset($_SESSION['userId'] ) ) {
                header('Location: /login');
                return;
            }
            if ( $_SESSION['userId'] != $response->owner->id ) {
                header('Location: /topic/edit-response?id='.$response->id);
                return;
            }

            $response = TopicResponseRepository::editResponse($_GET['id'], $_POST['response-content']);
            header('Location: /topic/?id='.$response->topic->id);

        }

        ob_start();
        
        require __DIR__.'/../View/edit-response.php';

        $page_contents = ob_get_clean();
        require __DIR__.'/../View/Template/page-layout.php';
    }

}
?>
<?php

session_start();

require_once(__DIR__.'/../Model/topicModel.php');
require_once(__DIR__.'/../Model/topicResponseModel.php');

class TopicResponseController extends TopicResponseRepository {


    public function __construct() {
        parent::__construct();
    }

    public function edit_page() {

        $response = $this->getResponseById($_GET['id']);

        if ( isset($_POST['response-content']) ) {

            if ( !isset($_SESSION['userId'] ) ) {
                header('Location: /login');
                return;
            }
            if ( $_SESSION['userId'] != $response->owner->id ) {
                header('Location: /topic/edit-response?id='.$response->id);
                return;
            }

            $response = $this->editResponse($_GET['id'], $_POST['response-content']);
            header('Location: /topic/?id='.$response->topic->id);

        }

        
        require(__DIR__.'/../View/edit-response.php');
    }

}
?>
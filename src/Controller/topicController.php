<?php

require_once __DIR__.'/../Model/topicModel.php';
require_once __DIR__.'/../Model/topicResponseModel.php';

class TopicController {

	public static function index(){


        if ( session_status() != PHP_SESSION_ACTIVE ){
            session_start();
        }

        if (isset($_GET['id']) ) {
            $topicId = $_GET['id'];
            
            if ( isset($_POST['response-content']) ) {

                if ( !isset($_SESSION['userId']) ) {
                    header('Location: /login');
                    return;
                }
                
                TopicResponseRepository::insertResponse($topicId, $_SESSION['userId'], $_POST["response-content"]);
                header('Location: /topic/?id='.$topicId);

            }


            $topic = TopicRepository::getTopicById($topicId);
            $responses = TopicResponseRepository::getResponsesByTopicId($topicId);

        } else {

            if ( isset($_POST['topic-title']) && isset($_POST['topic-content']) ) {

                if ( !isset($_SESSION['userId']) ) {
                    header('Location: /login');
                    return;
                }
                
                // if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
                //     $tmpFile = $_FILES['topic-url-profile']['tmp_name'];
                //     $newFile = '/'.$_FILES['topic-url-profile']['name'];
                //     $result = move_uploaded_file($tmpFile, $newFile);
                //     echo $_FILES['topic-url-profile']['name'];
                //     if ($result) {
                //         echo "test";
                //     } else {
                //         header('Location: /register');
                //     }
                // }

                $insertedTopic = TopicRepository::insertTopic($_SESSION['userId'], $_POST['topic-title'], $_POST['topic-content'], $_POST['topic-mood'], $_FILES['topic-header']);
                

                header('Location: /topic/?id='.$insertedTopic->id);

            }
        }

        ob_start();
        
        require __DIR__.'/../View/topic.php';

        $page_contents = ob_get_clean();
        require __DIR__.'/../View/Template/page-layout.php';
	}

    public static function edit_page() {

        if ( session_status() != PHP_SESSION_ACTIVE ){
            session_start();
        }

        $topic = TopicRepository::getTopicById($_GET['id']);

        if ( isset($_POST['topic-title']) && isset($_POST['topic-content']) ) {

            if ( !isset($_SESSION['userId'] ) ) {
                header('Location: /login');
                return;
            }
            
            if ( $_SESSION['userId'] != $topic->owner->id ) {
                header('Location: /topic/?id='.$topic->id);
                return;
            }

            $topic = TopicRepository::editTopic($_GET['id'], $_POST['topic-title'], $_POST['topic-content'], $_POST['topic-mood'], $_FILES['topic-header']);
            header('Location: /topic/?id='.$topic->id);
            
        }
        
        ob_start();
        
        require __DIR__.'/../View/edit-topic.php';

        $page_contents = ob_get_clean();
        require __DIR__.'/../View/Template/page-layout.php';
    }

    // public function create_page() {
    //     if (isset($_SESSION['userId']) ) {
    //         $user = $_SESSION['userId'];
    //         if(isset($_GET['title']) && isset($_GET['content'])){
    //             $newTopic = $this->insertTopic($user, $_GET['title'], $_GET['content']);
    //         }
            
    //         require __DIR__.'/../View/topic.php';
    //     } else {
    //         header('Location: /login');
    //     }
    // }
}
?>
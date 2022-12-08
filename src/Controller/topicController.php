<?php

session_start();

require_once(__DIR__.'/../Model/topicModel.php');
require_once(__DIR__.'/../Model/topicResponseModel.php');

class TopicController extends TopicRepository {

    private TopicResponseRepository $responseRepository;

    public function __construct() {
        parent::__construct();
        $this->responseRepository = new TopicResponseRepository();
    }

	public function index(){


        if (isset($_GET['id']) ) {
            $topicId = $_GET['id'];
            
            if ( isset($_POST['response-content']) ) {

                if ( !isset($_SESSION['userId']) ) {
                    header('Location: /login');
                    return;
                }
                
                $this->responseRepository->insertResponse($topicId, $_SESSION['userId'], $_POST["response-content"]);
                header('Location: /topic/?id='.$topicId);

            }


            $topic = $this->getTopicById($topicId);
            $responses = $this->responseRepository->getResponsesByTopicId($topicId);

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

                if (!isset($_POST['topic-url-profile'])) {
                    $_POST['topic-url-profile'] = "";
                }

                $insertedTopic = $this->insertTopic($_SESSION['userId'], $_POST['topic-title'], $_POST['topic-content'], $_POST['topic-mood'], $_POST['topic-url-profile']);
                

                header('Location: /topic/?id='.$insertedTopic->id);

            }


            $topics = $this->getTopics();
        }

        
        require(__DIR__.'/../View/topic.php');
	}


    public function edit_page() {

        $topic = $this->getTopicById($_GET['id']);

        if ( isset($_POST['topic-title']) && isset($_POST['topic-content']) ) {

            if ( !isset($_SESSION['userId'] ) ) {
                header('Location: /login');
                return;
            }
            if ( $_SESSION['userId'] != $topic->owner->id ) {
                header('Location: /topic/?id='.$topic->id);
                return;
            }

            if (!isset($_POST['topic-url-profile'])) {
                $_POST['topic-url-profile'] = "";
            }

            $topic = $this->editTopic($_GET['id'], $_POST['topic-title'], $_POST['topic-content'], $_POST['topic-mood'], $_POST['topic-url-profile']);
            header('Location: /topic/?id='.$topic->id);

        }

        
        require(__DIR__.'/../View/edit-topic.php');
    }

    // public function create_page() {
    //     if (isset($_SESSION['userId']) ) {
    //         $user = $_SESSION['userId'];
    //         if(isset($_GET['title']) && isset($_GET['content'])){
    //             $newTopic = $this->insertTopic($user, $_GET['title'], $_GET['content']);
    //         }
            
    //         require(__DIR__.'/../View/topic.php');
    //     } else {
    //         header('Location: /login');
    //     }
    // }
}
?>
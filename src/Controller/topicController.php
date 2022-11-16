<?php

session_start();

require_once(__DIR__.'/../Model/topicModel.php');
require_once(__DIR__.'/../Model/responseModel.php');

class TopicController {

    private TopicRepository $topicRepository;
    private ResponseRepository $responseRepository;

    public function __construct() {
        $this->topicRepository = new TopicRepository();
        $this->responseRepository = new ResponseRepository();
    }

    public function create_page() {
        if ( isset($_SESSION['user']) ) {
            
            $user = $_SESSION['user'];
            if(isset($_GET['title']) && isset($_GET['content'])){
                $newTopic = $this->topicRepository->insertTopic($user->id, $_GET['title'], $_GET['content']);
            }
            
            require(__DIR__.'/../View/topic.php');
        } else {
            header('Location: /login');
        }
    }

	public function get_page(){
        if (isset($_GET['id'])) {
            $topic = $this->topicRepository->getTopicById($_GET['id']);
            $responses = $this->responseRepository->getResponsesByTopicId($_GET['id']);
        } else {
            $topics = $this->topicRepository->getTopics();
        }
        require_once(__DIR__.'/../View/Template/topicDisplay.php');
	}
}
?>
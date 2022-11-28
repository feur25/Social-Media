<?php

session_start();

require_once(__DIR__.'/../Model/topicModel.php');
require_once(__DIR__.'/../Model/responseModel.php');

class TopicController extends TopicRepository {

    private ResponseRepository $responseRepository;

    public function __construct() {
        parent::__construct();
        $this->responseRepository = new ResponseRepository();
    }

	public function index(){
        if (isset($_GET['id'])) {
            $topic = $this->getTopicById($_GET['id']);
            $responses = $this->responseRepository->getResponsesByTopicId($_GET['id']);
        } else {
            $topics = $this->getTopics();
        }
        require(__DIR__.'/../View/topic.php');
	}

    public function create_page() {
        if (isset($_SESSION['userId']) ) {
            $user = $_SESSION['userId'];
            if(isset($_GET['title']) && isset($_GET['content'])){
                $newTopic = $this->insertTopic($user, $_GET['title'], $_GET['content']);
            }
            
            require(__DIR__.'/../View/topic.php');
        } else {
            header('Location: /login');
        }
    }
}
?>
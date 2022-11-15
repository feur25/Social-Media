<?php

require_once(__DIR__.'/../Model/topicModel.php');

class TopicController {

    private TopicRepository $topicRepository;

    public function __construct() {
        $this->topicRepository = new TopicRepository();
    }

	public function index(){
        $topics = $this->topicRepository->getTopic();
        if(isset($_GET["idTopic"])){
            $idTopic = $this->topicRepository->topicId($_GET["idTopic"]);
        }
		require(__DIR__.'/../View/topicDisplay.php');
	}
}
?>
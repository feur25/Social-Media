<?php

require_once(__DIR__.'/../Model/topicModel.php');
require_once(__DIR__.'/../Model/responseModel.php');

class TopicController {

    private TopicRepository $topicRepository;
    private ResponseRepository $responseRepository;

    public function __construct() {
        $this->topicRepository = new TopicRepository();
        $this->responseRepository = new ResponseRepository();
    }

	public function index(){
        $id = isset($_GET["idTopic"]) ? $_GET["idTopic"] : null;
        $topics = $this->topicRepository->getTopic();
        if(isset($_GET["idTopic"])){
            $idTopic = $this->topicRepository->topicId($id);
            $responses = $this->responseRepository->getResponse($id);
        }
		require(__DIR__.'/../View/topicDisplay.php');
	}
}
?>
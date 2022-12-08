<?php

require_once(__DIR__.'/repository.php');
require_once(__DIR__.'/topicModel.php');
require_once(__DIR__.'/userModel.php');

class TopicResponse {
    public int $id;
    public Topic $topic;
    public User $owner;
    public string $content;

    public function __construct(int $id, Topic $topic, User $owner, string $content) {
        $this->id = $id;
        $this->topic = $topic;
        $this->owner = $owner;
        $this->content = $content;
    }
}

class TopicResponseRepository extends Repository{

    public function insertResponse(int $topicId, int $senderId, string $content){
        $sql = $this->connection->prepare("INSERT INTO topic_response (topic_id, owner_id, content) VALUES (:topicId , :senderId, :content)");
        $sql->execute([
            'topicId' => $topicId,
            'senderId' => $senderId,
            'content' => $content
        ]);
    }

    public function editResponse(int $id, string $content) : TopicResponse {
        $sql = $this->connection->prepare("UPDATE topic_response SET content = :content WHERE id = :responseId");
        $sql->execute([
            'responseId' => $id,
            'content' => $content
        ]);

        return $this->getResponseById($id);
    }

    public function deleteResponse(int $responseId){
        $sql = $this->connection->prepare("DELETE FROM topic_response WHERE id = :responseId");
        $sql->execute([
            'responseId' => $responseId
        ]);
    }

    public function getResponseById(int $responseId) : ?TopicResponse {
        $sql = $this->connection->prepare('SELECT * FROM topic_response WHERE id = :responseId');
        $sql->execute( [
            'responseId'=> $responseId
        ] );

        $task = $sql->fetch();
        if (!$task)
            return null;

        $topicRepo = new TopicRepository();
        $userRepo = new UserRepository();
        
        return new TopicResponse($task['id'], $topicRepo->getTopicById($task['topic_id']), $userRepo->getUserById($task['owner_id']), $task['content']);
    }
    
    public function getResponsesByOwnerId(int $ownerId) : array {
        $sql = $this->connection->prepare('SELECT * FROM topic_response WHERE owner_id = :ownerId');
        $sql->execute([
            'ownerId'=> $ownerId
        ]);
        
        $array = $sql->fetchAll();

        $responseArray = [];
        foreach ($array as $task) {
            $responseArray[] = new TopicResponse($task['id'], $task['topic_id'], $task['owner_id'], $task['content']);
        }
        return $responseArray;
    }
    
    public function getResponsesByTopicId(int $topicId) : array {
        $sql = $this->connection->prepare('SELECT * FROM topic_response WHERE topic_id = :topicId');
        $sql->execute([
            'topicId'=> $topicId
        ]);
        
        $array = $sql->fetchAll();

        $topicRepo = new TopicRepository();
        $userRepo = new UserRepository();

        $responseArray = [];
        foreach ($array as $task) {
            $responseArray[] = new TopicResponse($task['id'], $topicRepo->getTopicById($task['topic_id']), $userRepo->getUserById($task['owner_id']), $task['content']);
        }
        return $responseArray;
    }

    public function getResponses() : array {
        $sql = $this->connection->prepare("SELECT * FROM topic_response LIMIT 20");
        $sql->execute();

        $array = $sql->fetchAll();

        $topicRepo = new TopicRepository();
        $userRepo = new UserRepository();

        $responseArray = [];
        foreach ($array as $task) {
            $responseArray[] = new TopicResponse($task['id'], $topicRepo->getTopicById($task['topic_id']), $userRepo->getUserById($task['owner_id']), $task['content']);
        }
        return $responseArray;
    }
}

?>
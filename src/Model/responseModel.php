<?php

require_once(__DIR__.'/repository.php');
require_once(__DIR__.'/topicModel.php');
require_once(__DIR__.'/userModel.php');

class Response {
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

class ResponseRepository extends Repository{

    public function insertResponse(int $topicId, int $ownerId, string $content){
        $sql = $this->connection->prepare("INSERT INTO topic_response (response_id, owner_id, content) VALUES (:topicId , :ownerId, :content)");
        $sql->execute([
            'topicId' => $topicId,
            'ownerId' => $ownerId,
            'content' => $content
        ]);
    }

    public function deleteResponse(int $responseId){
        $sql = $this->connection->prepare("DELETE FROM topic_response WHERE response_id = :responseId");
        $sql->execute([
            'responseId' => $responseId
        ]);
    }

    public function getResponseById(int $id) : Response {
        $sql = $this->connection->prepare('SELECT * FROM topic WHERE response_id = :id');
        $sql->execute( [
            'id'=> $id
        ] );

        $task = $sql->fetch();

        $topicRepo = new TopicRepository();
        $userRepo = new UserRepository();
        
        return new Response($task['response_id'], $topicRepo->getTopicById($task['topic_id']), $userRepo->getUserById($task['owner_id']), $task['content']);
    }
    
    public function getResponsesByOwnerId(int $id) : array {
        $sql = $this->connection->prepare('SELECT * FROM topic_response WHERE owner_id = :id');
        $sql->execute([
            'id'=> $id
        ]);
        
        $array = $sql->fetchAll();

        $responseArray = [];
        foreach ($array as $task) {
            $responseArray[] = new Response($task['response_id'], $task['topic_id'], $task['owner_id'], $task['content']);
        }
        return $responseArray;
    }
    
    public function getResponsesByTopicId(int $id) : array {
        $sql = $this->connection->prepare('SELECT * FROM topic_response WHERE topic_id = :id');
        $sql->execute([
            'id'=> $id
        ]);
        
        $array = $sql->fetchAll();

        $topicRepo = new TopicRepository();
        $userRepo = new UserRepository();

        $responseArray = [];
        foreach ($array as $task) {
            $responseArray[] = new Response($task['response_id'], $topicRepo->getTopicById($task['topic_id']), $userRepo->getUserById($task['owner_id']), $task['content']);
        }
        return $responseArray;
    }

    public function getResponses() : array {
        $sql = $this->connection->prepare("SELECT * FROM topic_response LIMIT 20");
        $sql->execute();
        if ($sql->rowCount() == 0) {
            return null;
        }

        $array = $sql->fetchAll();

        $topicRepo = new TopicRepository();
        $userRepo = new UserRepository();

        $responseArray= [];
        foreach ($array as $task) {
            $responseArray[] = new Response($task['response_id'], $topicRepo->getTopicById($task['topic_id']), $userRepo->getUserById($task['owner_id']), $task['content']);
        }
        return $responseArray;
    }
}

?>
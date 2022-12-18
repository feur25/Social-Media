<?php

require_once __DIR__.'/repository.php';
require_once __DIR__.'/topicModel.php';
require_once __DIR__.'/userModel.php';
require_once __DIR__ . '/../util/log.php' ;

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

class TopicResponseRepository {

    public static function insertResponse(int $topicId, int $senderId, string $content){
        $sql = Repository::getPDO()->prepare("INSERT INTO topic_response (topic_id, owner_id, content) VALUES (:topicId , :senderId, :content)");
        $sql->execute([
            'topicId' => $topicId,
            'senderId' => $senderId,
            'content' => $content
        ]);
        writeFile(__FUNCTION__, "L'utilisateur " . $senderId . " a répondu au topic " . $topicId . ".");
    }

    public static function editResponse(int $id, string $content) : TopicResponse {
        $sql = Repository::getPDO()->prepare("UPDATE topic_response SET content = :content WHERE id = :responseId");
        $sql->execute([
            'responseId' => $id,
            'content' => $content
        ]);
        writeFile(__FUNCTION__, "La réponse " . $id . " a été modifiée." );

        return TopicResponseRepository::getResponseById($id);
    }

    public static function deleteResponse(int $responseId){
        $sql = Repository::getPDO()->prepare("DELETE FROM topic_response WHERE id = :responseId");
        $sql->execute([
            'responseId' => $responseId
        ]);
        writeFile(__FUNCTION__, "La réponse " . $responseId . " a été supprimée." );
    }

    public static function getResponseById(int $responseId) : ?TopicResponse {
        $sql = Repository::getPDO()->prepare('SELECT * FROM topic_response WHERE id = :responseId');
        $sql->execute( [
            'responseId'=> $responseId
        ] );

        $task = $sql->fetch();
        if (!$task)
            return null;

        
        return new TopicResponse($task['id'], TopicRepository::getTopicById($task['topic_id']), UserRepository::getUserById($task['owner_id']), $task['content']);
    }
    
    public static function getResponsesByOwnerId(int $ownerId) : array {
        $sql = Repository::getPDO()->prepare('SELECT * FROM topic_response WHERE owner_id = :ownerId');
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
    
    public static function getResponsesByTopicId(int $topicId) : array {
        $sql = Repository::getPDO()->prepare('SELECT * FROM topic_response WHERE topic_id = :topicId');
        $sql->execute([
            'topicId'=> $topicId
        ]);
        
        $array = $sql->fetchAll();


        $responseArray = [];
        foreach ($array as $task) {
            $responseArray[] = new TopicResponse($task['id'],TopicRepository::getTopicById($task['topic_id']), UserRepository::getUserById($task['owner_id']), $task['content']);
        }
        return $responseArray;
    }

    public static function getResponses() : array {
        $sql = Repository::getPDO()->prepare("SELECT * FROM topic_response LIMIT 20");
        $sql->execute();

        $array = $sql->fetchAll();


        $responseArray = [];
        foreach ($array as $task) {
            $responseArray[] = new TopicResponse($task['id'], TopicRepository::getTopicById($task['topic_id']), UserRepository::getUserById($task['owner_id']), $task['content']);
        }
        return $responseArray;
    }
}

?>
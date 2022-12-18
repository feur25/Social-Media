<?php

require_once __DIR__.'/repository.php';
require_once __DIR__.'/topicModel.php';
require_once __DIR__.'/userModel.php';

class TopicReaction {
    public Topic $topic;
    public User $sender;
    public int $type;

    public function __construct(Topic $topic, User $sender, int $type) {
        $this->topic = $topic;
        $this->sender = $sender;
        $this->type = $type;
    }
}

class TopicReactionRepository {

    public static function insertReaction(int $topicId, int $senderId, int $type){
        // $sql = Repository::getPDO()->prepare("INSERT INTO topic_response (topic_id, owner_id, content) VALUES (:topicId , :senderId, :content)");
        // $sql->execute([
        //     'topicId' => $topicId,
        //     'senderId' => $senderId,
        //     'content' => $content
        // ]);
    }

    public static function getReactionBySenderId(int $senderId) : ?TopicResponse {
        // $sql = Repository::getPDO()->prepare('SELECT * FROM topic_response WHERE id = :responseId');
        // $sql->execute( [
        //     'responseId'=> $responseId
        // ] );

        // $task = $sql->fetch();
        // if (!$task)
        //     return null;

        
        // return new TopicResponse($task['id'], TopicRepository::getTopicById($task['topic_id']), UserRepository::getUserById($task['owner_id']), $task['content']);
    }
    
    public static function getReactionsByTopicId(int $ownerId) : array {
        // $sql = Repository::getPDO()->prepare('SELECT * FROM topic_response WHERE owner_id = :ownerId');
        // $sql->execute([
        //     'ownerId'=> $ownerId
        // ]);
        
        // $array = $sql->fetchAll();

        // $responseArray = [];
        // foreach ($array as $task) {
        //     $responseArray[] = new TopicResponse($task['id'], $task['topic_id'], $task['owner_id'], $task['content']);
        // }
        // return $responseArray;
    }

    public static function getReactions() : array {
        // $sql = Repository::getPDO()->prepare("SELECT * FROM topic_response LIMIT 20");
        // $sql->execute();

        // $array = $sql->fetchAll();


        // $responseArray = [];
        // foreach ($array as $task) {
        //     $responseArray[] = new TopicResponse($task['id'], TopicRepository::getTopicById($task['topic_id']), UserRepository::getUserById($task['owner_id']), $task['content']);
        // }
        // return $responseArray;
    }
}

?>
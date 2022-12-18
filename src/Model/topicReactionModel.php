<?php

require_once __DIR__.'/repository.php';
require_once __DIR__.'/topicModel.php';
require_once __DIR__.'/userModel.php';
require_once __DIR__ . '/../util/log.php' ;

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

class SortedTopicReaction {
    public array $thumbsUp;
    public array $thumbsDown;
    public array $laughing;
    public array $heart;
    public array $sad;

    public function __construct(array $thumbsUp, array $thumbsDown, array $laughing, array $heart, array $sad) {
        $this->thumbsUp = $thumbsUp;
        $this->thumbsDown = $thumbsDown;
        $this->laughing = $laughing;
        $this->heart = $heart;
        $this->sad = $sad;
    }
}

class TopicReactionRepository {

    public static function insertReaction(int $topicId, int $senderId, int $type){
        $sql = Repository::getPDO()->prepare("INSERT INTO topic_reaction (topic_id, sender_id, type) VALUES (:topicId , :senderId, :type)");
        $sql->execute([
            'topicId' => $topicId,
            'senderId' => $senderId,
            'type' => $type,
        ]);
    }

    public static function setReactionOnTopicFromSender(int $topicId, int $senderId, int $type) {

        $reaction = TopicReactionRepository::getReactionOnTopicFromSender($topicId, $senderId);
        if ($reaction == null) {
            TopicReactionRepository::insertReaction($topicId, $senderId, $type);
            return;
        }

        $sql = Repository::getPDO()->prepare("UPDATE topic_reaction SET type = :type WHERE topic_id = :topicId AND sender_id = :senderId");
        $sql->execute([
            'topicId' => $topicId,
            'senderId' => $senderId,
            'type' => $type,
        ]);
        writeFile(__FUNCTION__, "L'utilisateur " . $senderId . " a eu une réaction de type " . $type . " au topic " . $topicId . ".");
    }

    public static function removeReactionOnTopicFromSender(int $topicId, int $senderId) {
        $sql = Repository::getPDO()->prepare("DELETE FROM topic_reaction WHERE topic_id = :topicId AND sender_id = :senderId");
        $sql->execute([
            'topicId' => $topicId,
            'senderId' => $senderId,
        ]);
        writeFile(__FUNCTION__, "L'utilisateur " . $senderId . " a supprimé sa réaction au topic " . $topicId . ".");
    }

    public static function getReactionOnTopicFromSender(int $topicId, int $senderId) : ?TopicReaction {
        $sql = Repository::getPDO()->prepare('SELECT * FROM topic_reaction WHERE topic_id = :topicId AND sender_id = :senderId');
        $sql->execute( [
            'topicId'=> $topicId,
            'senderId'=> $senderId
        ] );

        $task = $sql->fetch();
        if (!$task)
            return null;

        return new TopicReaction(TopicRepository::getTopicById($task['topic_id']), UserRepository::getUserById($task['sender_id']), $task['type']);
    }

    public static function getReactionBySenderId(int $senderId) : ?TopicReaction {
        $sql = Repository::getPDO()->prepare('SELECT * FROM topic_reaction WHERE sender_id = :senderId');
        $sql->execute( [
            'senderId'=> $senderId
        ] );

        $task = $sql->fetch();
        if (!$task)
            return null;

        return new TopicReaction(TopicRepository::getTopicById($task['topic_id']), UserRepository::getUserById($task['sender_id']), $task['type']);
    }
    
    public static function getReactionsByTopicId(int $topicId) : array {
        $sql = Repository::getPDO()->prepare('SELECT * FROM topic_reaction WHERE topic_id = :topicId');
        $sql->execute([
            'topicId'=> $topicId
        ]);
        
        $array = $sql->fetchAll();

        $reactionArray = [];
        foreach ($array as $task) {
            $reactionArray[] = new TopicReaction(TopicRepository::getTopicById($task['topic_id']), UserRepository::getUserById($task['sender_id']), $task['type']);
        }
        return $reactionArray;
    }

    public static function getReactions(int $offset = 0, int $length = 10) : array {
        $sql = Repository::getPDO()->prepare("SELECT * FROM topic_reaction DESC LIMIT ".$offset.",".$length."");
        $sql->execute();

        $array = $sql->fetchAll();


        $reactionArray = [];
        foreach ($array as $task) {
            $reactionArray[] = new TopicReaction(TopicRepository::getTopicById($task['topic_id']), UserRepository::getUserById($task['sender_id']), $task['type']);
        }
        return $reactionArray;
    }

    public static function getSortedReactions(int $topicId) : SortedTopicReaction {
        $sql = Repository::getPDO()->prepare("SELECT * FROM topic_reaction WHERE topic_id = :topicId");
        $sql->execute([
            'topicId'=> $topicId,
        ]);

        $array = $sql->fetchAll();

        $thumbsUp = [];
        $thumbsDown = [];
        $laughing = [];
        $heart = [];
        $sad = [];

        $reactionArray = [];
        foreach ($array as $task) {
            $topic = TopicRepository::getTopicById($task['topic_id']);
            $sender = UserRepository::getUserById($task['sender_id']);
            if ($topic == null || $sender == null) {
                continue;
            }
            
            $reaction = new TopicReaction($topic, $sender, $task['type']);
            switch ($reaction->type) {
                default:
                    $thumbsUp[] = $reaction;
                    break;
                case 1:
                    $thumbsDown[] = $reaction;
                    break;
                case 2:
                    $laughing[] = $reaction;
                    break;
                case 3:
                    $heart[] = $reaction;
                    break;
                case 4:
                    $sad[] = $reaction;
                    break;
            }
        }
        
        return new SortedTopicReaction($thumbsUp, $thumbsDown, $laughing, $heart, $sad);
    }
}

?>
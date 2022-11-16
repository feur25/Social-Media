<?php

require_once(__DIR__.'/repository.php');

class Topic {
    public int $id;
    public int $ownerId;
    public string $title;
    public string $content;

    public function __construct(int $id, int $ownerId, string $title, string $content) {
        $this->id = $id;
        $this->ownerId = $ownerId;
        $this->title = $title;
        $this->content = $content;
    }
}

class TopicRepository extends Repository{

    public function insertTopic(int $userId, string $title, string $content) {
        $sql = $this->connection->prepare("INSERT INTO topic (owner_id, title, content) VALUES (:userId , :title , :content)");
        $sql->execute([
            'userId' => $userId,
            'title' => $title,
            'content' => $content
        ]);
    }

    public function deleteTopic($topicId) {
        $sql = $this->connection->prepare("DELETE FROM topic WHERE topic_id = :topicId");
        $sql->execute([
            'topicId' => $topicId
        ]);
    }

    public function getTopicById(int $id) : Topic {
        $sql = $this->connection->prepare('SELECT * FROM topic WHERE topic_id = :id');
        $sql->execute( [
            'id'=> $id
        ] );

        $array = $sql->fetch();

        return new Topic($array['topic_id'], $array['owner_id'], $array['title'], $array['content']);
    }
    
    public function getTopicsByOwnerId(int $id) : array {
        $sql = $this->connection->prepare('SELECT * FROM topic WHERE owner_id = :id');
        $sql->execute([
            'id'=> $id
        ]);
        
        $array = $sql->fetch();
        return new Topic($array['topic_id'], $array['owner_id'], $array['title'], $array['content']);
    }

    public function getTopics() : array {
        $sql = $this->connection->prepare("SELECT * FROM topic LIMIT 20");
        $sql->execute();
        if ($sql->rowCount() == 0) {
            return null;
        }
        $array = $sql->fetchAll(); 
        $topicArray = [];
        foreach ($array as $task) {
            $topicArray[] = new Topic($task['topic_id'], $task['owner_id'], $task['title'], $task['content']);
        }
        return $topicArray;
    }
}

?>
<?php

require_once(__DIR__.'/repository.php');
require_once(__DIR__.'/userModel.php');

class Topic {
    public int $id;
    public User $owner;
    public string $title;
    public string $content;
    public int $mood;
    public string $headerUrl;

    public function __construct(int $id, User $owner, string $title, string $content, int $mood, string $header) {
        $this->id = $id;
        $this->owner = $owner;
        $this->title = $title;
        $this->content = $content;
        $this->mood = $mood;
        $this->headerUrl = $header;
    }
}

class TopicRepository extends Repository{

    public function insertTopic(int $ownerId, string $title, string $content, int $mood, string $headerUrl) : ?Topic {
        $sql = $this->connection->prepare("INSERT INTO topic (owner_id, title, content, mood, header_url) VALUES (:ownerId, :title, :content, :mood, :headerUrl)");
        $status = $sql->execute([
            'ownerId' => $ownerId,
            'title' => $title,
            'content' => $content,
            'mood' => $mood,
            'headerUrl' => $headerUrl
        ]);

        if (!$status)
            throw new Exception("Failed to insert topic");

        $sql = $this->connection->query("SELECT last_insert_id();");
        $id = intval($sql->fetchColumn());
        
        return $this->getTopicById($id);
    }

    public function editTopic(int $id, string $title, string $content, int $mood, string $headerUrl) : Topic {
        $sql = $this->connection->prepare("UPDATE topic SET title = :title, content = :content, mood = :mood, header_url = :headerUrl WHERE id = :topicId");
        $sql->execute([
            'topicId' => $id,
            'title' => $title,
            'content' => $content,
            'mood' => $mood,
            'headerUrl' => $headerUrl
        ]);

        return $this->getTopicById($id);
    }

    public function deleteTopic($topicId) {
        $sql = $this->connection->prepare("DELETE FROM topic WHERE topic.id = :topicId; DELETE FROM topic_response WHERE topic_response.topic_id = :topicId");
        $sql->execute([
            'topicId' => $topicId
        ]);
    }

    public function getTopicById(int $id) : ?Topic {
        $sql = $this->connection->prepare('SELECT * FROM topic WHERE id = :id');
        $sql->execute( [
            'id'=> $id
        ] );

        $task = $sql->fetch();
        if (!$task)
            throw new Exception("Failed to get topic");

        $userRepo = new UserRepository();

        return new Topic($task['id'], $userRepo->getUserById($task['owner_id']), $task['title'], $task['content'], $task['mood'], $task['header_url']);
    }
    
    public function getTopicsByOwnerId(int $ownerId) : array {
        $sql = $this->connection->prepare('SELECT * FROM topic WHERE owner_id = :ownerId');
        $sql->execute([
            'ownerId'=> $ownerId
        ]);
        
        $array = $sql->fetchAll();

        $userRepo = new UserRepository();

        $topicArray = [];
        foreach($array as $topic) {
            $topicArray[] = new Topic($topic['id'], $userRepo->getUserById($topic['owner_id']), $topic['title'], $topic['content'], $topic['mood'], $topic['header_url']);
        }

        return $topicArray;
    }

    public function getTopics() : array {
        $sql = $this->connection->prepare("SELECT * FROM topic LIMIT 20");
        $sql->execute();
        $array = $sql->fetchAll();

        $userRepo = new UserRepository();

        $topicArray = [];
        foreach ($array as $task) {
            $topicArray[] = new Topic($task['id'], $userRepo->getUserById($task['owner_id']), $task['title'], $task['content'], $task['mood'], $task['header_url']);
        }
        return $topicArray;
    }
}

?>
<?php

require_once(__DIR__.'/repository.php');

class Topic {
    public int $id;
    public int $ownerId;
    public string $title;
    public string $text;

    public function __construct(int $id, int $ownerId, string $title, string $text) {
        $this->id = $id;
        $this->ownerId = $ownerId;
        $this->title = $title;
        $this->text = $text;
    }
}

class TopicRepository extends Repository{

    public function insertTopic(int $userId, string $title, string $subtitle) {
        $sql = $this->connection->prepare("INSERT INTO topic (owner_id, title, subtitle) VALUES (:userId , :title , :subtitle)");
        $sql->execute([
            'userId' => $userId,
            'title' => $title,
            'subtitle' => $subtitle
        ]);
    }

    public function deleteTopic($idTopic) {
        $sql = $this->connection->prepare("DELETE FROM topic WHERE topic_id = :idTopic");
        $sql->execute([
            'idTopic' => $idTopic
        ]);
    }
    public function topicId(int $topic_id) : array{
        $sql = $this->connection->prepare('SELECT* FROM topic where topic_id = ' . $topic_id);
        $sql->execute();
        $array  = $sql->fetchAll();
        $tableTask = [];
        foreach ($array as $task) {
            $tableTask[] = new Topic($task['topic_id'], $task['owner_id'], $task['title'], $task['subtitle']);
        }
        return $tableTask;
    }

    public function getTopic() : array {
        $sql = $this->connection->prepare("SELECT * FROM topic limit 20");
        $sql->execute();
        if ($sql->rowCount() == 0) {
            return null;
        }
        $array = $sql->fetchAll(); //fetchAll aussi non Illegal string offset de 'topic_id' / 'owner_id' / 'title' / 'subtitle'.
        $tableTask = [];
        foreach ($array as $task) {
            $tableTask[] = new Topic($task['topic_id'], $task['owner_id'], $task['title'], $task['subtitle']);
        }

        return $tableTask;
    }
}

?>
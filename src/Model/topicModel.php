<?php

require_once __DIR__.'/repository.php';
require_once __DIR__.'/userModel.php';
require_once __DIR__ . '/../util/log.php' ;

class Topic {
    public int $id;
    public User $owner;
    public string $title;
    public string $content;
    public int $mood;
    public string $headerUrl;

    public function __construct(int $id, User $owner, string $title, string $content, int $mood) {
        $this->id = $id;
        $this->owner = $owner;
        $this->title = $title;
        $this->content = $content;
        $this->mood = $mood;
    }
}

class TopicRepository {


    public static function updateHeader(int $id, array $headerFile) {
        $file_path = __DIR__.'/../../public/images/topic/'.$id.'/';

        if( isset( $headerFile ) ){

            if (!is_dir($file_path)) {
                mkdir($file_path);
            }

            // Move the file and convert it to jpg if needed
            switch ($headerFile['type']) {
                case 'image/png':
                    // Convert png to jpg
                    $tmpName = $headerFile['tmp_name'];
                    $image = imagecreatefrompng($tmpName);
                    imagejpeg($image, $file_path.'header.jpg', 100);
                    imagedestroy($image);
                    break;
                case 'image/gif':
                    // Convert gif to jpg
                    $tmpName = $headerFile['tmp_name'];
                    $image = imagecreatefromgif($tmpName);
                    imagejpeg($image, $file_path.'header.jpg', 100);
                    imagedestroy($image);
                    break;
                case 'image/webp':
                    // Convert webp to jpg
                    $tmpName = $headerFile['tmp_name'];
                    $image = imagecreatefromwebp($tmpName);
                    imagejpeg($image, $file_path.'header.jpg', 100);
                    imagedestroy($image);
                    break;
                default:
                    $tmpName = $headerFile['tmp_name'];
                    move_uploaded_file($tmpName, $file_path.'header.jpg');
                    break;
            }
        }
        writeFile(__FUNCTION__, "Une image de couverture a été ajoutée au Topic " . $id);
    }

    public static function insertTopic(int $ownerId, string $title, string $content, int $mood, array $headerFile) : ?Topic {
        $sql = Repository::getPDO()->prepare("INSERT INTO topic (owner_id, title, content, mood) VALUES (:ownerId, :title, :content, :mood)");
        $status = $sql->execute([
            'ownerId' => $ownerId,
            'title' => $title,
            'content' => $content,
            'mood' => $mood
        ]);

        if (!$status)
            return null;

        $sql = Repository::getPDO()->query("SELECT last_insert_id();");
        $id = intval($sql->fetchColumn());

        TopicRepository::updateHeader($id, $headerFile);
        writeFile(__FUNCTION__, "Un nouveau topic a été créé par " . $ownerId . ".");
        return TopicRepository::getTopicById($id);
    }

    public static function editTopic(int $id, string $title, string $content, int $mood, array $headerFile ) : Topic {

        $sql = Repository::getPDO()->prepare("UPDATE topic SET title = :title, content = :content, mood = :mood WHERE id = :topicId");
        $sql->execute([
            'topicId' => $id,
            'title' => $title,
            'content' => $content,
            'mood' => $mood
        ]);

        TopicRepository::updateHeader($id, $headerFile);
        writeFile(__FUNCTION__, "Le topic " . $id . " a été modifié.");
        return TopicRepository::getTopicById($id);
    }

    public static function deleteTopic($topicId) {
        $sql = Repository::getPDO()->prepare("DELETE FROM topic WHERE topic.id = :topicId; DELETE FROM topic_response WHERE topic_response.topic_id = :topicId");
        $sql->execute([
            'topicId' => $topicId
        ]);
        writeFile(__FUNCTION__, "Le topic " . $topicId . " a été supprimé.");
    }

    public static function getTopicById(int $id) : ?Topic {
        $sql = Repository::getPDO()->prepare('SELECT * FROM topic WHERE id = :id');
        $sql->execute( [
            'id'=> $id
        ] );

        $task = $sql->fetch();
        if (!$task)
            return null;

        return new Topic($task['id'], UserRepository::getUserById($task['owner_id']), $task['title'], $task['content'], $task['mood']);
    }

    public static function getTopics(int $offset = 0, int $length = 10) : array {
        $sql = Repository::getPDO()->prepare("SELECT * FROM `topic` ORDER BY `date` DESC LIMIT ".$offset.",".$length."");
        $sql->execute();
        $array = $sql->fetchAll();
        

        $topicArray = [];
        foreach ($array as $task) {
            $topicArray[] = new Topic($task['id'], UserRepository::getUserById($task['owner_id']), $task['title'], $task['content'], $task['mood']);
        }
        return $topicArray;
    }
    
    public static function getTopicsByOwnerId(int $ownerId, int $offset = 0, int $length = 10) : array {
        $sql = Repository::getPDO()->prepare("SELECT * FROM topic WHERE owner_id = :ownerId ORDER BY `date` DESC LIMIT ".$offset.",".$length."");
        $sql->execute([
            'ownerId'=> $ownerId
        ]);
        
        $array = $sql->fetchAll();

        $topicArray = [];
        foreach($array as $topic) {
            $topicArray[] = new Topic($topic['id'], UserRepository::getUserById($topic['owner_id']), $topic['title'], $topic['content'], $topic['mood']);
        }

        return $topicArray;
    }
}

?>
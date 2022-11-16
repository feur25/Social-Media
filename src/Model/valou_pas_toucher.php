<?php
class Emoji{
    public int $owner_id;
    public int $topic_id;
    public int $message_id;
    public int $id;

    
    public function __construct(int $userId, int $topicId, int $commentId, int $emojiiD){
        $this->owner_id = $userId;
        $this->topic_id = $topicId;
        $this->message_id = $commentId;
        $this->id = $emojiiD;
    }
}
class EmojiRepository extends Repository{
    public function addEmojiNewComment(int $userId, int $topicId, int $messageId){
        $sql = $this->connection->prepare('INSERT INTO emoji (owner_id, topic_id, message_id) VALUES (:id_user, :id_topic, :id_message');
        $sql->execute([
            'id_user' => $userId,
            'id_topic' => $topicId,
            'id_message' => $messageId,
            'id'=> $id
        ]);
    }
    public function deleteEmojiComment(int $id){
        $sql = $this->connection->prepare('DELETE FROM emoji WHERE id =' . $id);
        $sql->execute();
    }
    public function display() : Emoji {
        return new Emoji();
    }
}

?>
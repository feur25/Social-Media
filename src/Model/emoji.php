<?php

class Emojitab{
    public int $ownerId;
    public int $topicId;
    public int $messageId;
    public int $id;

    public function __construct(int $userId, int $topicId, int $commentId, int $emojiiD){
        $this->ownerId = $userId;
        $this->topicId = $topicId;
        $this->messageId = $commentId;
        $this->id  = $emojiiD;
    }
}

class EmojitabRepository extends Repository{
    public function validityEmoji(int $userId, int $isTopic, int $isMessage) : bool {
        $sql =  $this->connection->prepare("SELECT * FROM emoji WHERE owner_id = "  . $userId . " AND topic_id = " . $isTopic . " OR owner_id = "  . $userId . " AND topic_id = " . $isMessage);
        $sql->execute();
        if ($sql->rowCount() == 0) {
            return false;
        }
        return true;
    }
    public function toggleEmoji(int $ownerId, int $isTopic, int $isMessage){
        if (!$this->validityEmoji($ownerId, $isTopic, $isMessage)){
            $sql =  $this->connection->prepare("INSERT INTO emoji (owner_id, topic_id, message_id) VALUES (:userId , :topic_id , :message_id)");
            $sql->execute([
                'userId' => $ownerId,
                'topic_id' => $this->isMessage($isMessage, $isTopic),
                'messsage_id' => $this->isTopic($isTopic, $isMessage)
            ]);
        }else{
            $sql =  $this->connection->prepare("DELETE FROM emoji WHERE owner_id = "  . $ownerId . " AND topic_id = " . $isTopic . " OR owner_id = "  . $ownerId . " AND topic_id = " . $isMessage);
            $sql->execute();
        }
    }
    public function checkIfIsMesssage() : bool {
        $sql =  $this->connection->prepare("SELECT * FROM emoji WHERE message_id >= -1 ");
        $sql->execute();
        if ($sql->rowCount() == 0) {
            return true;
        }
        return false;
    }
    public function isMessage(int $messageId, int $topicId) : int {
        if($messageId >= 0){
            return -1;
        }
        return $topicId;
    }
    public function isTopic(int $topicId, int $messageId) : int {
        if ($topicId >= 0){
            return -1;
        }
        return $messageId;
    }
}



?>
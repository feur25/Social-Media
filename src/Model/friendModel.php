<?php

require_once(__DIR__.'/userModel.php');

class Friend{
    public int $id;
    public User $sender;
    public User $receiver;
    public int $state;

    public function __construct(int $id, User $sender, User $receiver, int $state){
        $this->id = $id;
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->state = $state;
    }
}

class FriendRepository extends UserRepository {


    public function friendRequestExists(int $userId, int $friendId) : bool{
        $sql =  $this->connection->prepare("SELECT * FROM friend WHERE (sender_id = :userId AND receiver_id = :friendId) OR (sender_id = :friendId AND receiver_id = :userId)");
        $sql->execute( [
            'userId' => $userId,
            'friendId' => $friendId
        ] );

        return $sql->rowCount() > 0;
    }

    public function sendRequest(int $senderId, int $receiverId){
        if ($this->friendRequestExists($senderId, $receiverId)) {
            return;
        }
        
        $sql =  $this->connection->prepare("INSERT INTO friend (sender_id, receiver_id, state) VALUES (:senderId, :receiverId, 0)");
        $sql->execute([
            'senderId' => $senderId,
            'receiverId' => $receiverId
        ]);

        $message = 'sent request : ' . $senderId . ' to ' . $receiverId;
        echo "<script>console.log('" . $message . "');</script>";
            
    }

    public function getFriends(int $userId) : array{
        $sql = $this->connection->prepare("SELECT * FROM friend WHERE (sender_id = :userId OR receiver_id = :userId) AND state = 1 ");
        $sql->execute( [
            'userId' => $userId
        ] );

        $array = $sql->fetchAll();

        $friendArray = [];
        foreach ($array as $friend) {
            $friendArray[] = new Friend($friend['id'], $this->getUserById($friend['sender_id']), $this->getUserById($friend['receiver_id']), $friend['state']);
        }
        return $friendArray;
    }

    public function getRequestsBySenderId(int $senderId) : array {
        $sql = $this->connection->prepare("SELECT * FROM friend WHERE sender_id = :senderId AND state = 0 ");
        $sql->execute( [
            'senderId' => $senderId
        ] );

        $array = $sql->fetchAll(); 

        $pendingArray = [];
        foreach ($array as $pending) {
            $pendingArray[] = new Friend($pending['id'], $this->getUserById($pending['sender_id']), $this->getUserById($pending['receiver_id']), $pending['state']);
        }
        return $pendingArray;
    }

    public function getRequestsByReceiverId(int $receiverId) : array {
        $sql = $this->connection->prepare("SELECT * FROM friend WHERE receiver_id = :receiverId AND state = 0 ");
        $sql->execute( [
            'receiverId' => $receiverId
        ] );

        $array = $sql->fetchAll(); 

        $pendingArray = [];
        foreach ($array as $pending) {
            $pendingArray[] = new Friend($pending['id'], $this->getUserById($pending['sender_id']), $this->getUserById($pending['receiver_id']), $pending['state']);
        }
        return $pendingArray;
    }

    public function declineRequest(int $requestId){
        $sql =  $this->connection->prepare("DELETE FROM friend WHERE id = :requestId" );
        $sql->execute( [
            'requestId' => $requestId
        ] );
    }

    public function acceptRequest(int $requestId){
        $sql =  $this->connection->prepare("UPDATE friend SET state = 1 WHERE id = :requestId" );
        $sql->execute( [
            'requestId' => $requestId
        ] );
    }

}
?>
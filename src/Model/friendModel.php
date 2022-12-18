<?php

require_once __DIR__.'/userModel.php';
require_once __DIR__ . '/../util/log.php' ;

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

class FriendRepository {



    public static function getRequestById(int $requestId) : Friend{
        $sql = Repository::getPDO()->prepare("SELECT * FROM friend WHERE id = :requestId");
        $sql->execute( [
            'requestId' => $requestId
        ] );

        $request = $sql->fetch();

        return new Friend($request['id'], UserRepository::getUserById($request['sender_id']), UserRepository::getUserById($request['receiver_id']), $request['state']);
    }

    public static function getRequestsBySenderId(int $senderId) : array {
        $sql = Repository::getPDO()->prepare("SELECT * FROM friend WHERE sender_id = :senderId AND state = 0 ");
        $sql->execute( [
            'senderId' => $senderId
        ] );

        $array = $sql->fetchAll(); 

        $pendingArray = [];
        foreach ($array as $pending) {
            $pendingArray[] = new Friend($pending['id'], UserRepository::getUserById($pending['sender_id']), UserRepository::getUserById($pending['receiver_id']), $pending['state']);
        }
        return $pendingArray;
    }

    public static function getRequestsByReceiverId(int $receiverId) : array {
        $sql = Repository::getPDO()->prepare("SELECT * FROM friend WHERE receiver_id = :receiverId AND state = 0 ");
        $sql->execute( [
            'receiverId' => $receiverId
        ] );

        $array = $sql->fetchAll(); 

        $pendingArray = [];
        foreach ($array as $pending) {
            $pendingArray[] = new Friend($pending['id'], UserRepository::getUserById($pending['sender_id']), UserRepository::getUserById($pending['receiver_id']), $pending['state']);
        }
        return $pendingArray;
    }
    
    public static function friendRequestExists(int $userId, int $friendId) : bool{
        $sql = Repository::getPDO()->prepare("SELECT * FROM friend WHERE (sender_id = :userId AND receiver_id = :friendId) OR (sender_id = :friendId AND receiver_id = :userId)");
        $sql->execute( [
            'userId' => $userId,
            'friendId' => $friendId
        ] );

        return $sql->rowCount() > 0;
    }

    public static function sendRequest(int $senderId, int $receiverId){
        if (FriendRepository::friendRequestExists($senderId, $receiverId)) {
            return;
        }
        
        $sql = Repository::getPDO()->prepare("INSERT INTO friend (sender_id, receiver_id, state) VALUES (:senderId, :receiverId, 0)");
        $sql->execute([
            'senderId' => $senderId,
            'receiverId' => $receiverId
        ]);

        $message = 'sent request : ' . $senderId . ' to ' . $receiverId;
        echo "<script>console.log('" . $message . "');</script>";
        writeFile(__FUNCTION__, $senderId . " a ajouté " . $receiverId . " en ami.");  
    }

    public static function getFriends(int $userId) : array{
        $sql = Repository::getPDO()->prepare("SELECT * FROM friend WHERE (sender_id = :userId OR receiver_id = :userId) AND state = 1 ");
        $sql->execute( [
            'userId' => $userId
        ] );

        $array = $sql->fetchAll();

        $friendArray = [];
        foreach ($array as $friend) {
            $friendArray[] = new Friend($friend['id'], UserRepository::getUserById($friend['sender_id']), UserRepository::getUserById($friend['receiver_id']), $friend['state']);
        }
        return $friendArray;
    }

    public static function declineRequest(int $requestId){
        $sql = Repository::getPDO()->prepare("DELETE FROM friend WHERE id = :requestId" );
        $sql->execute( [
            'requestId' => $requestId
        ] );
        writeFile(__FUNCTION__, "La demande d'amis" . $requestId . " a été rejetée.");
    }

    public static function acceptRequest(int $requestId){
        $sql = Repository::getPDO()->prepare("UPDATE friend SET state = 1 WHERE id = :requestId" );
        $sql->execute( [
            'requestId' => $requestId
        ] );
        writeFile(__FUNCTION__, "La demande d'amis " . $requestId . " a été acceptée.");
    }

}
?>
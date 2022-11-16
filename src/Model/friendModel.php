<?php
 class Friend{
    public int $first_user_id;
    public int $state;
    public int $second_user_id;

    public function __construct(int $firstId, int $state, int $secondId){
        $this->first_user_id = $firstId;
        $this->state = $state;
        $this->second_user_id = $secondId;
    }
 }
 class friendRepository extends Repository{
    public function addResquest(int $userId, int $friendId){
        $sql =  $this->connection->prepare("INSERT INTO friend (first_user_id, second_user_id) VALUES (:userId , :friendId)");
        $sql->execute([
            'userId' => $userId,
            'friendId' => $friendId
        ]);
    }
    public function yourPendingRequest(int $userId) : ?Friend{
        $sql = $this->connection->prepare("SELECT second_user_id FROM friend WHERE first_user_id = " . $userId . " AND state != 0");
        $sql->execute();
        $array = $sql->fetch();
        return new Friend($array['first_user_id'], $array['state'], $array['second_user_id']);
    }

    public function receiveRequest(int $userId) : ?Friend{
        $sql = $this->connection->prepare("SELECT first_user_id FROM friend WHERE second_user_id = " . $userId . " AND state != 0");
        $sql->execute();
        $array = $sql->fetch();
        return new Friend($array['first_user_id'], $array['state'], $array['second_user_id']);
    }
    public function declineRequest(int $userId, int $anotherId){
        $sql =  $this->connection->prepare("DELETE FROM friend WHERE first_user_id = " .$userId . " AND second_user_id = " . $anotherId . " OR first_user_id = " . $anotherId . " AND second_user_id = " . $userId);
        $sql->execute();
    }
    public function validityRequest(int $userId, int $anotherId){
        $sql =  $this->connection->prepare("UPDATE friend SET state = 0 WHERE first_user_id = " . $userId . " AND second_user_id = ". $anotherId );
        $sql->execute();
    }
    public function yourFriend(int $userId, int $anotherId) : int{
        $sql = $this->connection->prepare("SELECT state FROM friend WHERE first_user_id = " .$userId . " AND second_user_id = " . $anotherId . " OR first_user_id = " . $anotherId . " AND second_user_id = " . $userId);
        return $sql->execute();
    }
 }
?>
<?php
require_once(__DIR__.'/repository.php');
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
 class FriendRepository extends Repository{
    public function checkIfExistInDB(int $userId, int $friendId) : bool{
        $sql =  $this->connection->prepare("SELECT * FROM friend WHERE first_user_id = " . $userId . " AND second_user_id = " . $friendId . " OR first_user_id = " . $friendId . " AND second_user_id = " . $userId);
        $sql->execute();
        if ($sql->rowCount() > 1) {
            return false;
        }
        return true;
    }
    public function addResquest(int $userId, int $friendId){
        if ($this->checkIfExistInDB($userId, $friendId)){
            $sql =  $this->connection->prepare("INSERT INTO friend (first_user_id, state ,  second_user_id) VALUES (:userId , :state, :friendId)");
            $sql->execute([
                'userId' => $userId,
                'state' => 1,
                'friendId' => $friendId
            ]);
        }else{
            echo "Tu as déja envoyer une invitation a cette personne ";
        }
    }
    public function yourPendingRequest(int $userId) : array{
        $sql = $this->connection->prepare("SELECT * FROM friend WHERE first_user_id = " . $userId . " AND state != 0 OR second_user_id = " . $userId . " AND state != 0");
        $sql->execute();
        $array = $sql->fetchAll(); 
        $pendingArray = [];
        foreach ($array as $pending) {
            $pendingArray[] = new Friend($pending['first_user_id'], $pending['state'], $pending['second_user_id']);
        }
        return $pendingArray;
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
        $sql =  $this->connection->prepare("UPDATE friend SET state = 0 WHERE first_user_id = " . $userId . " AND second_user_id = ". $anotherId  . " OR first_user_id = " . $anotherId . " AND second_user_id = ". $userId );
        $sql->execute();
    }

    public function yourFriend(int $userId) : array{
        $sql = $this->connection->prepare("SELECT * FROM friend WHERE first_user_id = " .$userId . " AND state = 0 OR second_user_id = " . $userId . " AND state = 0 ");
        $sql->execute();
        $array = $sql->fetchAll(); 
        $friendArray = [];
        foreach ($array as $friend) {
            $friendArray[] = new Friend($friend['first_user_id'], $friend['state'], $friend['second_user_id']);
        }
        return $friendArray;
    }
 }
?>
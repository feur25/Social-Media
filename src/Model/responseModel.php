<?php

require_once(__DIR__.'/repository.php');

class Response {
    public int $id;
    public int $topicId;
    public int $ownerId;
    public string $text;

    public function __construct(int $id, int $topicId, int $ownerId, string $text) {
        $this->id = $id;
        $this->topicId = $topicId;
        $this->ownerId = $ownerId;
        $this->text = $text;
    }
}

class ResponseRepository extends Repository{

    public function insertResponse(int $topicId, int $userId, int $responseId, string $response){
        $sql = $this->connection->prepare("INSERT INTO topic_response (topic_id, owner_id, response_id, response) VALUES (:topicId , :userId , :responseId, :response)");
        $sql->execute([
            'topicId' => $topicId,
            'userId' => $userId,
            'responseId' => $responseId,
            'response' => $response
        ]);
    }

    public function deleteResponse(int $idResponse){
        $sql = $this->connection->prepare("DELETE FROM topic_response WHERE response_id = :idResponse");
        $sql->execute([
            'idResponse' => $idResponse
        ]);
    }

    public function getResponse(int $idTopic) : array {
        $sql = $this->connection->prepare("SELECT * FROM topic_response WHERE topic_id = " . $idTopic . " limit 20");
        $sql->execute();
        $array = $sql->fetchAll();
        $tableResponse = [];
        foreach ($array as $response) {
            $tableResponse[] = new Response($response['response_id'], $response['topic_id'], $response['owner_id'], $response['response']);
        }
        return $tableResponse;
    }
}

?>
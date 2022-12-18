<?php

require_once __DIR__.'/repository.php';
require_once __DIR__.'/userModel.php';
require_once __DIR__.'/../util/encrypt.php';

class PrivateMessage {
    public int $id;
    public int $senderId;
    public int $receiverId;
    public string $message;
    public string $messageDate;
    
    public function __construct(int $id, int $senderId, int $receiverId, string $message, string $messageDate) {
        $this->id = $id;
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->message = $message;
        $this->messageDate = $messageDate;
    }
}

class PrivateMessageRepository {


    public static function sendMessage(User $sender, User $receiver, string $content) {

        // Encrypt the message using the sender's public key
        $encryptedSenderMessage = $content;

        // Encrypt the message using the receiver's public key
        $encryptedReceiverMessage = $content;

        $sql = Repository::getPDO()->prepare( "INSERT INTO private_message (sender_id, receiver_id, sender_message, receiver_message) VALUES (:senderId, :receiverId, :senderMessage, :receiverMessage)" );
        $sql->execute( [
            'senderId' => $sender->id,
            'receiverId' => $receiver->id,
            'senderMessage' => $encryptedSenderMessage,
            'receiverMessage' => $encryptedReceiverMessage
        ] );
    }

    public static function getMessages(int $username, int $email) : ?User {
        
        $sql = Repository::getPDO()->prepare("SELECT * FROM users WHERE (username = :username OR email = :email) ");
        $sql->execute( [
            'username' => $username,
            'email' => $email,
        ] );
        

        if ($sql->rowCount() == 0) {
            return null;
        }

        $array = $sql->fetch();
        return new User($array['id'], $array['username'], $array['email'], $array['password'], $array['date']);
    }

    // public static function getUserById(int $id) : ?User {
        
    //     $sql = Repository::getPDO()->prepare("SELECT * FROM users WHERE id = :id");
    //     $sql->execute( [
    //         'id' => $id,
    //     ] );
        

    //     if ($sql->rowCount() == 0) {
    //         return null;
    //     }

    //     $array = $sql->fetch();
    //     return new User($array['id'], $array['username'], $array['email'], $array['password'], $array['date']);
    // }

    // public static function getUserByIdentifierAndPassword(string $identifier, string $password) : ?User {

    //     $sql = Repository::getPDO()->prepare("SELECT * FROM users WHERE (username = :identifier OR email = :identifier) AND password = :password");
    //     $sql->execute( [
    //         'identifier' => $identifier,
    //         'password' => $password
    //     ] );
        

    //     if ($sql->rowCount() == 0) {
    //         return null;
    //     }

    //     $array = $sql->fetch();
    //     return new User($array['id'], $array['username'], $array['email'], $array['password'], $array['date']);
    // }
}

?>
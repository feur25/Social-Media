<?php

session_start();

require_once(__DIR__.'/../Model/friendModel.php');
require_once(__DIR__.'/../Model/userModel.php');

class FriendController extends FriendRepository {

    public function index(){

        if (isset($_SESSION['userId']) ) {

            $userId = $_SESSION['userId'];


            if(isset($_POST["send-request"])){
                $requestedUser = $this->getUserByIdentifier($_POST["request-identifier"]);
                $this->sendRequest($userId, $requestedUser->id);
            }

            if(isset($_POST["accept-request"])){
                $this->acceptRequest($_POST["accept-request"]);
            }
            if(isset($_POST['decline-request'])){
                $this->declineRequest($_POST["decline-request"]);
            }


            $receivedRequests = $this->getRequestsByReceiverId($userId);
            $sentRequests = $this->getRequestsBySenderId($userId);
            $friends = $this->getFriends($userId);

            require(__DIR__.'/../View/friend.php');


        }else{
            header('Location: ../login');
        }
    }
}

?>
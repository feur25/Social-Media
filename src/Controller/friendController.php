<?php

session_start();

require_once(__DIR__.'/../Model/friendModel.php');
require_once(__DIR__.'/../Model/userModel.php');

class FriendController {

    private FriendRepository $friendRepository;
    private UserRepository $userRepository;

    public function __construct() {
        $this->friendRepository = new FriendRepository();
        $this->userRepository = new UserRepository();
    }

    public function friend_page() : array{
        $user =  $_SESSION['userId'];
        $array = $this->friendRepository->yourFriend($user);
        return $array;
    }

    public function checkValidityOrNot(){
        $user =  $_SESSION['userId'];
        if(isset($_GET["acceptRequest"])){
            $this->friendRepository->validityRequest($user, $_GET["acceptRequest"]);
        }
        if(isset($_GET['declineRequest'])){
            $this->friendRepository->declineRequest($user, $_GET["declineRequest"]);
        } 
    }

    public function friend_pending() : array{
        $user =  $_SESSION['userId'];
        $array = $this->friendRepository->yourPendingRequest($user);
        return $array;
    }
    public function convertIdToName() : array {
        $friendsId = $this->friend_page();
        $nameFriend = array();
        foreach($friendsId as $friendId){
            if($friendId->first_user_id == $_SESSION['userId']){
                array_push($nameFriend, $this->userRepository->getUser($friendId->second_user_id));
            }else{
                array_push($nameFriend, $this->userRepository->getUser($friendId->first_user_id));
            }
        }
        return $nameFriend;
    }
    public function convertObjectToArray(Object $myObject) :array {
        $myArray = json_decode(json_encode($myObject), true);
        return $myArray;
    }
    public function convertNameToId(string $get) : int {
        $userAdd = $this->userRepository->getUserByUsernameOrEmail($get, $get);
        $userId = $this->convertObjectToArray($userAdd);
        return (int)$userId['id'];
    }

    public function index(){
        $user = $_SESSION['userId'];
        if (isset($user) ) {
            require(__DIR__.'/../View/friend.php');
            if (isset($_POST['receive'])){
                $requests = $this->friend_pending();
                $this->checkValidityOrNot();
                require_once(__DIR__.'/../View/Template/list-pending-friend.php');
            }
            if(isset($_POST['request'])){
                $requests = $this->friend_pending();
                $this->checkValidityOrNot();
                require_once(__DIR__.'/../View/Template/list-receive-friend.php');
            }
            if(isset($_POST['friend'])){
                $friends = $this->convertIdToName();
                
                require_once(__DIR__.'/../View/Template/list-friend.php');
            }
            if(isset($_GET["sendRequest"])){
                $id = $this->convertNameToId($_GET["sendRequest"]);
                $this->friendRepository->addResquest($user->id, $id);
            }

        }else{
            header('Location: /login');
        }
    }
}
?>
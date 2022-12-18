<?php

require_once __DIR__.'/../Model/friendModel.php';
require_once __DIR__.'/../Model/userModel.php';

class FriendController {

    public static function index(){


        if ( session_status() != PHP_SESSION_ACTIVE ){
            session_start();
        }

        if ( !isset($_SESSION['userId']) ) {
            header('Location: /login');
            return;
        }

        $userId = $_SESSION['userId'];


        if(isset($_POST["send-request"])){
            $requestedUser = UserRepository::getUserByIdentifier($_POST["request-identifier"]);
            FriendRepository::sendRequest($userId, $requestedUser->id);
        }

        ob_start();

        require __DIR__.'/../View/friend.php';

        $page_contents = ob_get_clean();
        require __DIR__.'/../View/Template/page-layout.php';

    }
}

?>
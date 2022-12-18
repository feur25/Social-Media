<?php

require_once __DIR__.'/../src/Model/friendModel.php';

if ( isset($_GET['id']) ) {
    $friend = FriendRepository::getRequestById($_GET['id']);

    if ( $friend->sender->id == $_SESSION['userId'] || $friend->receiver->id == $_SESSION['userId'] ) {
        FriendRepository::acceptRequest($_GET['id']);
    }
    header('Location: '.$_SERVER['HTTP_REFERER']);
}


?>
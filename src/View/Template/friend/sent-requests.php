<div id="sent-friend-requests">
    
    <h3>Sent Friend Requests</h3>

    <?php
    require_once __DIR__."/../../../util/translate.php";

    if ( session_status() != PHP_SESSION_ACTIVE ){
        session_start();
    }

    if ( isset($_SESSION['userId']) ) {
        $userId = $_SESSION['userId'];
    
        require_once __DIR__."/../../../Model/friendModel.php";
    
        $sentRequests = FriendRepository::getRequestsBySenderId($userId);


        foreach($sentRequests as $sentRequest){
            if($sentRequest->sender->id == $userId){
    
                ?>
                <div class="friend-sent">
                    <?php
                    $user = $sentRequest->receiver;
                    require __DIR__."/../user/preview.php" 
                    ?>
                    <div class="friend-sent-options">
                        <a class="link" href="/friend/delete/?id=<?= $sentRequest->id ?>"><?= translate("cancel") ?></a>
                    </div>
                </div>
                <?php
    
            }
        }
    }
    ?>

</div>
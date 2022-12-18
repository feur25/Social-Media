<div id="received-friend-requests">

    <h3>Received Friend Requests</h3>
    
    <?php
    require_once __DIR__."/../../../util/translate.php";

    if ( session_status() != PHP_SESSION_ACTIVE ){
        session_start();
    }

    if ( isset($_SESSION['userId']) ) {
        $userId = $_SESSION['userId'];
    
        require_once __DIR__."/../../../Model/friendModel.php";
    
        $receivedRequests = FriendRepository::getRequestsByReceiverId($userId);
    

        foreach($receivedRequests as $receivedRequest){
            if($receivedRequest->receiver->id == $userId){
                
                ?>
                    <div class="friend">
                        <?php
                        $user = $receivedRequest->sender;
                        require __DIR__."/../user/preview.php" 
                        ?>
                        <div class="friend-options">
                            <a class="link-small" href="/friend/accept/?id=<?= $receivedRequest->id ?>"><?= translate("accept_request") ?></a>
                            <a class="link-small" href="/friend/delete/?id=<?= $receivedRequest->id ?>"><?= translate("decline_request") ?></a>
                        </div>
                    </div>
                <?php
    
            }
        }
    }
    ?>

</div>
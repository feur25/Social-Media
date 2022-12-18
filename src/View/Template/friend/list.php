<div id="friends-list">
    
    <h3>Friends</h3>

    <?php
    require_once __DIR__."/../../../util/translate.php";

    if ( session_status() != PHP_SESSION_ACTIVE ){
        session_start();
    }

    if ( isset($_SESSION['userId']) ) {
        $userId = $_SESSION['userId'];
    
        require_once __DIR__."/../../../Model/friendModel.php";
    
        $friends = FriendRepository::getFriends($userId);


        foreach($friends as $friend){
            if ($friend->sender->id == $userId) {
                $user = $friend->receiver;
            } else {
                $user = $friend->sender;
            }

            ?>
            <div class="friend">
                <?php
                require __DIR__."/../user/preview.php" 
                ?>
                <div class="friend-options">
                    <a class="link-small" href="/friend/delete/?id=<?= $friend->id ?>"><?= translate("delete") ?></a>
                </div>
            </div>
            <?php
        }
    
    }
    ?>

</div>
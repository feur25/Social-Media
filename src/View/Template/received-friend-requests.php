<div id="received-friend-requests">

    <h3>Received Friend Requests</h3>
    
    <?php
    foreach($receivedRequests as $receivedRequest){
        if($receivedRequest->receiver->id == $_SESSION['userId']){
            
            ?>
                <p><?=$receivedRequest->sender->username ?></p>
                <form  class="friend" method="post" action="">
                    <button id="accept-request" name="accept-request" value="<?= $receivedRequest->id ?>" >Accept</button>
                    <button id="decline-request" name="decline-request" value="<?= $receivedRequest->id ?>" >Decline</button>
                <form>
            <?php

        }
    }
    ?>

</div>
<div id="sent-friend-requests">
    
<h3>Sent Friend Requests</h3>

<?php
    foreach($sentRequests as $sentRequest){
        if($sentRequest->sender->id == $_SESSION['userId']){

            ?>
                <p><?=$sentRequest->receiver->username ?></p>
                    <form  class="friend" method="post" action="">
                        <button id="decline-request" name="decline-request" value="<?= $sentRequest->id ?>" >Cancel</button>
                    <form>
                <br>
            <?php

        }
    }
?>

</div>
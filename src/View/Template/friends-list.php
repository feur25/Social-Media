<div id="friends-list">
    
<h3>Friends</h3>

<?php 

    if ( !isset($_SESSION['userId']) ) {
        header('Location: login');
    }

    foreach($friends as $friend){
        if ($friend->sender->id == $_SESSION['userId']) {
            $friendUser = $friend->receiver;
        } else {
            $friendUser = $friend->sender;
        }

        ?>
            <div class="friend">
                <p><?= $friendUser->username ?></p>
                <form class="friend" method="post" action="">
                    <button id="decline-request" name="decline-request" value="<?= $friend->id ?>" >Delete</button>
                <form>
            </div>
        <?php
    }

?>

</div>
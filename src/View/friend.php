<?php 

require_once __DIR__."/../../util/translate.php";

ob_start();

?>

    <form action="" method="post">
        <input type="text" name="request-identifier" placeholder="<?= translate("identifier") ?>" />
        <input type="submit" name="send-request" value="<?= translate("confirm") ?>">
    </form>
    <div class="tab_menu">
        <form action="" method="post">
            <input type="submit" name="receivedRequest" value="<?= translate("received_requests") ?>" />
            <input type="submit" name="sentRequest" value="<?= translate("sent_requests") ?>" />
            <input type="submit" name="message" value="<?= translate("messages") ?>" />
        </form>
    </div>


    <div class="none">
        <?php
            require __DIR__.'/Template/friends-list.php';
        ?>
    </div>
    <div class="none">
        <?php
            require __DIR__.'/Template/sent-friend-requests.php';
        ?>
    </div>
            <!-- require __DIR__.'/Template/received-friend-requests.php';
            require __DIR__.'/Template/sent-friend-requests.php';
            require __DIR__.'/Template/friends-list.php'; -->
    </div>

<?php

$page_contents = ob_get_clean();
require(__DIR__.'/Template/page-layout.php');

?>
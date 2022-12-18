<?php 

require_once __DIR__."/../util/translate.php";

?>

<form method="post" id="friend-request-form">
    <input type="text" name="request-identifier" placeholder="<?= translate("identifier") ?>" />
    <input type="submit" name="send-request" value="<?= translate("confirm") ?>">
</form>
<!-- <form method="post" id="">
    <input type="submit" name="receivedRequest" value="<?= translate("received_requests") ?>" />
    <input type="submit" name="sentRequest" value="<?= translate("sent_requests") ?>" />
    <input type="submit" name="message" value="<?= translate("messages") ?>" />
</form> -->


<div id="friends-wall">
    <?php
        require __DIR__.'/Template/friend/list.php';
    ?>
    <?php
        require __DIR__.'/Template/friend/sent-requests.php';
    ?>
    <?php
        require __DIR__.'/Template/friend/received-requests.php';
    ?>
</div>
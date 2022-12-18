<script>
    socket.on("sendmsg", function(msg){
        document.getElementById("messages").innerHTML += msg + "<br>" ;
    })
    function sendmsg(){
        socket.emit("sendmsg", document.getElementById("message").value);
    }
</script>
<?php
    if (isset($_SESSION['userId'])) {
        ?>
            <form class="response-form" method="post" action="">
                
                <textarea class="content" name="response-content" placeholder="<?= translate("content") ?>" id="message"><?= isset($_GET["content"]) ? $_GET["content"] : "" ?></textarea>
                <button class="btn" onclick="sendmsg()"><?= translate("confirm") ?></button>

            </form>
        <?php
    } else {
        ?>
            <a href="/login" class="link"><?= translate("login_to_respond") ?></p>
        <?php
    }

?>
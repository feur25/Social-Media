<?php

    if (isset($_SESSION['userId'])) {
        ?>
            <form class="response-form" method="post" action="">
                
                <input type="text" class="content" name="response-content" placeholder="<?= translate("content") ?>" <?= isset($_GET["content"]) ? "value=\"".$_GET["content"]."\"" : "" ?>/>
                <button class="submit"><?= translate("confirm") ?></button>

            </form>
        <?php
    } else {
        ?>
            <a href="/login"><?= translate("login-to-respond") ?></p>
        <?php
    }

?>
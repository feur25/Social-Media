<?php

require_once(__DIR__.'/../../Model/userModel.php');

if (isset($user)) {
    ?>
        <div class="user-preview">
            <h3>
                <?= $user->username; ?>
            </h3>
        </div>
    <?php
}

?>

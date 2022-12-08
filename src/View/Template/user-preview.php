<?php

require_once(__DIR__.'/../../Model/userModel.php');

if (isset($user)) {
    ?>
        <div class="user-preview">
            <h3>
                
                <img class="profil_picture" src="<?= $user->profileUrl; ?>" />
                <p> <?= $user->username; ?> </p>
            </h3>
        </div>
    <?php
}

?>
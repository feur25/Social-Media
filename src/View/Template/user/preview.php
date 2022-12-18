<?php

require_once __DIR__.'/../../../Model/userModel.php';

if ( isset($user) ) {
    ?>
    <a class="user-preview" href="/user/?id=<?= $user->id; ?>">
        <img class="profil-picture" src="<?= $user->profileUrl; ?>" />
        <span class="preview-username"><?= $user->username; ?></span>
    </a>
    <?php
}

?>
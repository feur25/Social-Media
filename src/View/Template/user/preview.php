<?php

require_once __DIR__.'/../../../Model/userModel.php';

if ( isset($user) ) {
    ?>
    <a class="user-preview" href="/user/?id=<?= $user->id; ?>">
        <img class="user-picture" src="<?= UserRepository::getProfilePicURL($user) ?>" />
        <span class="user-name"><?= $user->username; ?></span>
    </a>
    <?php
}
?>
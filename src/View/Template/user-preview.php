<div class="profile-preview">
    <?php

        require_once(__DIR__.'/../../Model/userModel.php');

        if (isset($user)) {
            ?>
                <h3>
                    <?= $user->username; ?>
                </h3>
            <?php
        }
    ?>
</div>
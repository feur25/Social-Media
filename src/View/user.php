<?php

require_once __DIR__."/../util/translate.php";

if ( isset($user) ) {
        
    ?>

    <img class="profil-picture" src="<?= $user->profileUrl; ?>" />
    <h1><?= $user->username ?></h1>
    <p><?= $user->email ?></p>
    <p><?= translate("joined_on") . " " . $user->date ?></p>
    

    <div class="rod"></div>


    <h1><?= translate("topics_by") ?></h1>
    <div id="user-topics-list"></div>

    <?php

}

?>
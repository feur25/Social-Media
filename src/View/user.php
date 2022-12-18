<?php

require_once __DIR__."/../util/translate.php";
require_once __DIR__ . "/../Model/userModel.php";

if ( isset($user) ) {
        
    ?>

    <img class="user-picture" src="<?= UserRepository::getProfilePicURL($user) ?>" />
    <h1 class="user-name"><?= $user->username ?></h1>
    <p class="user-email"><?= $user->email ?></p>
    <p class="user-join-date"><?= translate("joined_on") . " " . $user->date ?></p>
    
    
    <form method="post" enctype="multipart/form-data" >
        <input type="file" class="content" name="user-header"/>
        <button class="btn"><?= translate("confirm") ?></button>
    </form>
    <?php
        if(isset($_FILES['user-header'])){
            UserRepository::updateProfilePic($user->id, $_FILES['user-header']);
        }
    ?>

    <div class="rod"></div>


    <h1><?= translate("topics_by") ?></h1>
    <div id="user-topics-list"></div>

    <?php

}

?>
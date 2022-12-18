<?php

require_once __DIR__."/../util/translate.php";
require_once __DIR__.'/../Model/topicModel.php';
require_once __DIR__.'/../Controller/topicController.php';

?>

<div class="home">
    
    <div id="nav-side">
        <?php include __DIR__."/Template/friend/list.php"; ?>
    </div>

    <div id="topics-wall">
        <div id="topics-list"></div>
    </div>

</div>
<?php

require_once __DIR__."/../../util/translate.php";

ob_start();

?>


<form class="create-topic" method="post" action="">
    
    <input type="text" id="title" name="title" placeholder="<?= translate("title") ?>"/>
    <input type="text" id="content" name="content" placeholder="<?= translate("content") ?>"/>
    <button id="submit"><?= translate("confirm") ?></button>
    
</form>

<?php
    if (isset($topic)) {
        require(__DIR__."/Template/topic.php");

        if (isset($responses)) {
            foreach ($responses as $response) {
                require(__DIR__."/Template/topic-response.php");
            }
        }
    }
    if (isset($topics)) {
        foreach ($topics as $topic) {
            require(__DIR__."/Template/topic-preview.php");
        }
    }
?>

<?php
    $page_contents = ob_get_clean();
    require(__DIR__.'/Template/page-layout.php');
?>
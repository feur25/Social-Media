<?php

require_once __DIR__."/../../util/translate.php";

ob_start();

?>

<?php
    if ( isset($topic) ) {
        
        require(__DIR__."/Template/topic/topic.php");

    } else {
        require(__DIR__."/Template/topic/form.php");

        if (isset($topics)) {
            foreach ($topics as $topic) {
                require(__DIR__."/Template/topic/preview.php");
            }
        }
    }
?>

<?php
    $page_contents = ob_get_clean();
    require(__DIR__.'/Template/page-layout.php');
?>
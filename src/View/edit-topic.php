<?php

require_once __DIR__."/../../util/translate.php";

ob_start();

?>

<?php
    require(__DIR__."/Template/topic/form.php");
?>

<?php
    $page_contents = ob_get_clean();
    require(__DIR__.'/Template/page-layout.php');
?>
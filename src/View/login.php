<?php

require_once __DIR__."/../../util/translate.php";

ob_start();

?>

<p class="header_titre"><?= translate("login") ?></p>

<form class="login-form" method="get" action="">
    
    <input type="text" id="id" name="id" placeholder="<?= translate("identifier") ?>"/>
    <input type="password" id="password" name="password" placeholder="<?= translate("password") ?>">
    <button id="envoyer"><?= translate("confirm") ?></button>
    
</form>

<h3 style="color: red;"> <?= isset($error_message) ? $error_message : "" ?></h3>


<?php

$page_contents = ob_get_clean();
require(__DIR__.'/Template/page-layout.php');

?>
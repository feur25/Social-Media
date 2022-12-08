<?php

require_once __DIR__."/../../util/translate.php";

ob_start();

?>

<p class="header_title"><?= translate("register") ?></p>

<form class="login-form" method="post" action="">
    
    <input type="email" id="email" name="email" placeholder="<?= translate("email") ?>"/>
    <input type="text" id="username" name="username" placeholder="<?= translate("username") ?>"/>
    <input type="password" id="password" name="password" placeholder="<?= translate("password") ?>">
    <input type="password" id="password-confirm" name="password-confirm" placeholder="<?= translate("confirm_password") ?>">
    <button id="envoyer"><?= translate("confirm") ?></button>
    
</form>

<h3 style="color: red;"> <?= isset($error_message) ? $error_message : "" ?></h3>


<?php

$page_contents = ob_get_clean();
require(__DIR__.'/Template/page-layout.php');

?>
<?php
require_once __DIR__."/../../../util/translate.php";
?>

<p class="header-title"><?= translate("register") ?></p>
<a href="/" class="flex-items">X</a>

<form class="login-form" method="post" action="">
    
    <input class="flex-items" type="password" id="password" name="password" placeholder="<?= translate("old_password") ?>">
    <input class="flex-items" type="password" id="password" name="password" placeholder="<?= translate("new_password") ?>">
    <input class="flex-items" type="password" id="password-confirm" name="password-confirm" placeholder="<?= translate("confirm_password") ?>">
    
</form>
<a href="register.php" id="create" class="flex-items"><?= translate("create_account") ?></a>

<h3 style="color: red;"> <?= isset($error_message) ? $error_message : "" ?></h3>

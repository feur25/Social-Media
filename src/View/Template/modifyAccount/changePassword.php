<?php
require_once __DIR__."/../../../util/translate.php";
?>

<a href="/" class="annul">X</a>

<form class="login-form" method="post" action="">
    
    <input type="password" id="password" name="password" placeholder="<?= translate("old_password") ?>">
    <input type="password" id="password" name="password" placeholder="<?= translate("new_password") ?>">
    <input type="password" id="password-confirm" name="password-confirm" placeholder="<?= translate("confirm_password") ?>">
    
</form>
<a href="register.php" class="btn"><?= translate("confirm") ?></a>

<h3 style="color: red;"> <?= isset($error_message) ? $error_message : "" ?></h3>

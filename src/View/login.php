<?php

require_once __DIR__."/../util/translate.php";

?>

<p class="header-title"><?= translate("login") ?></p>
<a href="/" class="flex-items2">X</a>

<form class="login-form" method="get" action="">
    <input class="flex-items" type="text" name="id" placeholder="<?= translate("identifier") ?>"/>
    <input class="flex-items" type="password" name="password" placeholder="<?= translate("password") ?>">
    <button class="flex-items btn-confirm" ><?= translate("confirm") ?></button>
</form>
<form method="get" action="/modifyPassword.php">
    <a href="register.php" id="create" class="flex-items" name="register"><?= translate("create_account") ?></a>
    <button class="flex-items" name="modifyPassword"  value="modifyPassword" ><?= translate("modify_password") ?></button>
    <button class="flex-items" name="forgetPassword"  value="forgetPassword" ><?= translate("forgot_password") ?></button>
</form>
<input class="flex-items" type="text" maxlength="1" min="0" max="9" step="1" pattern="[0-9][a-z][A-Z]{1}"/>
<h3 style="color: red;"> <?= isset($error_message) ? $error_message : "" ?></h3>
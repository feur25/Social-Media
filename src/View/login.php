<?php

require_once __DIR__."/../util/translate.php";

?>

<a href="/" class="annul">X</a>

<form class="login-form" method="get" action="">
    <input class="" type="text" name="id" placeholder="<?= translate("identifier") ?>"/>
    <input class="" type="password" name="password" placeholder="<?= translate("password") ?>">
    <button class="btn" ><?= translate("confirm") ?></button>
</form>
<form method="get" action="/modifyPassword.php">
    <a href="register.php" class="btn" name="register"><?= translate("create_account") ?></a>
    <button class="btn" name="modifyPassword" value="modifyPassword" ><?= translate("modify_password") ?></button>
    <button class="btn" name="forgetPassword" value="forgetPassword" ><?= translate("forgot_password") ?></button>
</form>
<input class="" type="text" maxlength="1" min="0" max="9" step="1" pattern="[0-9][a-z][A-Z]{1}"/>
<h3 style="color: red;"> <?= isset($error_message) ? $error_message : "" ?></h3>
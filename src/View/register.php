<?php
require_once __DIR__."/../util/translate.php";
?>

<p class="header-title"><?= translate("register") ?></p>
<a href="/" class="flex-items2">X</a>

<form class="register-form" autocomplete="off" method="post" action="">
    
    <input class="flex-items" type="email" name="email" placeholder="<?= translate("email") ?>"/>
    <input class="flex-items" type="text" name="username" placeholder="<?= translate("username") ?>"/>
    <input class="flex-items" type="password" name="password" placeholder="<?= translate("password") ?>">
    <input class="flex-items" type="password" name="password-confirm" placeholder="<?= translate("confirm_password") ?>">
    <button class="flex-items"><?= translate("confirm") ?></button>
    
</form>

<h3 style="color: red;"> <?= isset($error_message) ? $error_message : "" ?></h3>

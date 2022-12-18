<?php
require_once __DIR__."/../util/translate.php";
?>

<a href="/" class="annul">X</a>

<form class="register-form" autocomplete="off" method="post" action="">
    
    <input type="email" name="email" placeholder="<?= translate("email") ?>"/>
    <input type="text" name="username" placeholder="<?= translate("username") ?>"/>
    <input type="password" name="password" placeholder="<?= translate("password") ?>">
    <input type="password" name="password-confirm" placeholder="<?= translate("confirm_password") ?>">
    <button class="btn"><?= translate("confirm") ?></button>
    
</form>

<h3 style="color: red;"> <?= isset($error_message) ? $error_message : "" ?></h3>

<?php
ob_start();
?>

<p class="header_titre">Créer un Compte</p>

<form class="login-form" method="post" action="">
    
    <input type="email" id="email" name="email"/>
    <input type="text" id="username" name="username"/>
    <input type="password" id="password" name="password">
    <input type="password" id="password-confirm" name="password-confirm">
    <button id="envoyer">Login</button>
    
</form>

<h3 style="color: red;"> <?= isset($error_message) ? $error_message : "" ?></h3>


<?php

$page_contents = ob_get_clean();
require(__DIR__.'/page-layout.php');

?>
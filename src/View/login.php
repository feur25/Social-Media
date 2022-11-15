<?php
ob_start();
?>

<p class="header_titre">Se Connecter</p>

<form class="login-form" method="get" action="">
    
    <input type="text" id="id" name="id"/>
    <input type="password" id="password" name="password">
    <button id="envoyer">Login</button>
    
</form>

<h3 style="color: red;"> <?= isset($error_message) ? $error_message : "" ?></h3>


<?php

$page_contents = ob_get_clean();
require(__DIR__.'/page-layout.php');

?>
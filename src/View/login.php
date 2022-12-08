<?php

require_once __DIR__."/../../util/translate.php";

ob_start();

?>


<body>
    <p class="header_title"><?= translate("login") ?></p>

    <div>
        <form class="login-form" method="get" action="">
            
            <input class="flex-items" type="text" id="id" name="id" placeholder="<?= translate("identifier") ?>"/>
            <input class="flex-items" type="password" id="password" name="password" placeholder="<?= translate("password") ?>">
            <input type="checkbox"class="remember" id="remember"value="remember">
            <label for="remember" class="remember">remember</label>
            <button class="flex-items" id="envoyer"><?= translate("confirm") ?></button>
            
        </form>
    </div>

    <h3 style="color: red;"> <?= isset($error_message) ? $error_message : "" ?></h3>



</body>

<?php

$page_contents = ob_get_clean();
require(__DIR__.'/Template/page-layout.php');

?>
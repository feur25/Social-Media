<?php

require_once __DIR__."/../../util/translate.php";

?>

<!DOCTYPE html>
<html>

    <meta charset="UTF-8">
    <head>
        <link rel="stylesheet" href="/public/CSS/style.css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script src="/public/scripts/user-language.js" type="text/javascript" defer></script>
        <script src="/public/scripts/lazy-load.js" type="text/javascript" defer></script>
    </head>

    <body>
        <div id="header">

            <div id="nav-user">
                <?php
                if ( isset($_SESSION['userId']) ) {

                    ?>
                    <?php require __DIR__.'/user/logged-preview.php'; ?>
                    <a href="/logout" class="link">
                        <?= translate("logout") ?>
                    </a>
                    <?php

                } else {

                    ?>  
                    <a href="/login" class="link">
                        <?= translate("login") ?> 
                    </a>
                    <?php
                }
                ?>
            </div>
            
            <form>
                <select id="user-language-form" name="user-language">
                    <?php
                    if (!isset($_COOKIE['language'])) {
                        $_COOKIE['language'] = "english";
                    }
                    ?>
                    <option value="english" <?= isset($_COOKIE['language']) && $_COOKIE['language'] == "english" ? "selected" : "" ?>>English</option>
                    <option value="french" <?= isset($_COOKIE['language']) && $_COOKIE['language'] == "french" ? "selected" : "" ?>>Français</option>
                    <option value="spanish" <?= isset($_COOKIE['language']) && $_COOKIE['language'] == "spanish" ? "selected" : "" ?>>Español</option>
                </select>
            </form>

            <div id="nav">
                <a href="/" class="link">
                    <?= translate("home") ?>
                </a>
                <a href="/friend" class="link">
                    <?= translate("friends") ?>
                </a>
                <a href="/topic" class="link">
                    <?= translate("topics") ?>
                </a>
            </div>
            
        </div>
        <?= $page_contents; ?>

    </body>
</html>
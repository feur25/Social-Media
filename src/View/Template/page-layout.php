<?php

require_once __DIR__."/../../util/translate.php";

?>

<!DOCTYPE html>
<html>

    <meta charset="UTF-8">
    <head>
        <link rel="stylesheet" href="/public/CSS/style.css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script src="/public/scripts/lazy-load.js" type="text/javascript" defer></script>
    </head>

    <body class="home">
        <div id="header">

            <p class="header-title">Social-Media</p>
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

            <div id="nav">
                <a href="/" class="link">
                    Home
                </a>
                <a href="/friend" class="link">
                    Friends
                </a>
                <a href="/message" class="link">
                    Messages
                </a>
                <a href="/topic" class="link">
                    Topic
                </a>
                <a href="/setting" class="link">
                    Settings
                </a>
            </div>
            
        </div>
        <script>var socket = io();</script>
        <?= $page_contents; ?>

    </body>
</html>
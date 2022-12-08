<?php

require_once __DIR__."/../../../util/translate.php";
?>

<!DOCTYPE html>
<html>

    <meta charset="UTF-8">
    <head>
        <link rel="stylesheet" href="/public/CSS/style.css"/> 
    </head>

    <body class="home">
        <div id="header">
            <?php

                if ( isset($_SESSION['userId']) ) {

                    require('loggedUser-preview.php');

                    ?>   
                        <p class="header_title">Social-Media</p>
                        <a href="/logout.php">
                            <?= translate("logout") ?>
                        </a>
                    <?php

                } else {

                    ?>  
                        <p class="header_title">Social-Media</p>
                        <a href="/login.php">
                            <?= translate("login") ?>
                        </a>
                    <?php
                }
            ?>
            
        </div>
        <?= $page_contents; ?>
    </body>
</html>
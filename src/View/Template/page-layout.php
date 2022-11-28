<?php

require_once __DIR__."/../../../util/translate.php";

?>

<html>

    <head>
        <link rel="stylesheet" href="/public/CSS/style.css"/> 
    </head>

    <body>
        <div id="header">
            <?php

                if ( isset($_SESSION['userId']) ) {

                    require('loggedUser-preview.php');

                    ?>  
                        <a href="/logout.php">
                            <?= translate("logout") ?>
                        </a>
                    <?php

                } else {

                    ?>  
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
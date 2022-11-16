<html>

    <head>
        <link rel="stylesheet" href="public/CSS/style.css"/> 
    </head>

    <body>
        <div id="header">
            <?php

                if ( isset($_SESSION['userId']) ) {

                    require('loggedUser-preview.php');

                    ?>  
                        <a href="/logout.php">
                            Se Déconnecter
                        </a>
                    <?php

                } else {

                    ?>  
                        <a href="/login.php">
                            Se Connecter
                        </a>
                    <?php
                }
            ?>
        </div>
        <?= $page_contents; ?>
    </body>
</html>